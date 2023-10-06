<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\Customer\Helper;

use Codeception\Module;
use Codeception\Module\WebDriver;
use Codeception\Stub;
use Generated\Shared\DataBuilder\CustomerBuilder;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\NewsletterSubscriberTransfer;
use Generated\Shared\Transfer\NewsletterSubscriptionRequestTransfer;
use Generated\Shared\Transfer\NewsletterTypeTransfer;
use Orm\Zed\Country\Persistence\SpyCountryQuery;
use Orm\Zed\Customer\Persistence\SpyCustomer;
use Orm\Zed\Customer\Persistence\SpyCustomerAddress;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use PyzTest\Yves\CompanyUser\Helper\CompanyUserHelper;
use PyzTest\Yves\Customer\PageObject\CustomerAddressesPage;
use PyzTest\Yves\Customer\PageObject\CustomerLoginPage;
use Spryker\Client\Session\SessionClient;
use Spryker\Shared\Newsletter\NewsletterConstants;
use Spryker\Zed\Customer\Business\CustomerFacadeInterface;
use Spryker\Zed\Customer\CustomerDependencyProvider;
use Spryker\Zed\Customer\Dependency\Facade\CustomerToMailBridge;
use Spryker\Zed\Mail\Business\MailFacadeInterface;
use Spryker\Zed\Newsletter\Business\NewsletterFacade;
use SprykerTest\Shared\Customer\Helper\CustomerDataHelper;
use SprykerTest\Shared\Testify\Helper\DependencyHelperTrait;
use SprykerTest\Shared\Testify\Helper\LocatorHelperTrait;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class CustomerHelper extends Module
{
    use DependencyHelperTrait;
    use LocatorHelperTrait;

    /**
     * @param string $email
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomer|null
     */
    public function loadCustomerByEmail($email): ?SpyCustomer
    {
        $customerQuery = new SpyCustomerQuery();
        $customerEntity = $customerQuery->findOneByEmail($email);

        return $customerEntity;
    }

    /**
     * @param array $seed
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function haveRegisteredCustomer(array $seed = []): CustomerTransfer
    {
        $this->setupSession();

        $customerTransfer = $this->createCustomer($seed);

        $this->getModule('\\' . CompanyUserHelper::class)
            ->haveRegisteredCompanyUser($customerTransfer)
            ->getCustomer();

        return $customerTransfer;
    }

    /**
     * @param string $email
     * @param string $address
     * @param bool $isDefaultShipping
     * @param bool $isDefaultBilling
     *
     * @return void
     */
    public function addAddressToCustomer($email, $address, $isDefaultShipping = true, $isDefaultBilling = true): void
    {
        $customerEntity = $this->loadCustomerByEmail($email);
        $addressTransfer = CustomerAddressesPage::getAddressData($address);

        $countryQuery = new SpyCountryQuery();
        $countryEntity = $countryQuery->findOneByIso2Code($addressTransfer->getIso2Code());

        $customerAddressEntity = new SpyCustomerAddress();
        $customerAddressEntity->fromArray($addressTransfer->toArray());
        $customerAddressEntity->setFkCountry($countryEntity->getIdCountry());
        $customerEntity->addAddress($customerAddressEntity);

        if ($isDefaultShipping) {
            $customerEntity->setShippingAddress($customerAddressEntity);
        }
        if ($isDefaultBilling) {
            $customerEntity->setBillingAddress($customerAddressEntity);
        }

        $customerEntity->save();
    }

    /**
     * @param string $email
     * @param string $type
     *
     * @return void
     */
    public function addNewsletterSubscription($email, $type = NewsletterConstants::DEFAULT_NEWSLETTER_TYPE): void
    {
        $customerEntity = $this->loadCustomerByEmail($email);
        $newsletterSubscriberTransfer = new NewsletterSubscriberTransfer();
        $newsletterSubscriberTransfer->setEmail($email);
        $newsletterSubscriberTransfer->setFkCustomer($customerEntity->getIdCustomer());

        $newsletterSubscriptionType = new NewsletterTypeTransfer();
        $newsletterSubscriptionType->setName($type);

        $newsletterSubscriptionRequestTransfer = new NewsletterSubscriptionRequestTransfer();
        $newsletterSubscriptionRequestTransfer->setNewsletterSubscriber($newsletterSubscriberTransfer);
        $newsletterSubscriptionRequestTransfer->addSubscriptionType($newsletterSubscriptionType);

        $newsletterFacade = new NewsletterFacade();
        $newsletterFacade->subscribeWithDoubleOptIn($newsletterSubscriptionRequestTransfer);
    }

    /**
     * @param array $seed
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function amLoggedInCustomer(array $seed = []): CustomerTransfer
    {
        $customerTransfer = $this->haveRegisteredCustomer($seed);

        $tester = $this->getWebDriver();
        $tester->amOnPage(CustomerLoginPage::URL);
        $tester->waitForElement('[name=loginForm]', 30);
        $tester->submitForm(['name' => 'loginForm'], [
            CustomerLoginPage::FORM_FIELD_SELECTOR_EMAIL => $customerTransfer->getEmail(),
            CustomerLoginPage::FORM_FIELD_SELECTOR_PASSWORD => $customerTransfer->getPassword(),
        ]);

        $tester->wait(2);

        return $customerTransfer;
    }

    /**
     * @param array $seed
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    protected function createCustomer(array $seed = []): CustomerTransfer
    {
        $mailMock = new CustomerToMailBridge($this->getMailMock());
        $this->setDependency(CustomerDependencyProvider::FACADE_MAIL, $mailMock);

        $customerTransfer = (new CustomerBuilder($seed))->build();
        $password = $customerTransfer->getPassword();

        $customerTransfer = $this->getModule('\\' . CustomerDataHelper::class)
            ->haveCustomer($customerTransfer->toArray() + [
                CustomerTransfer::PASSWORD => $password,
            ]);

        $this->getCustomerFacade()->confirmCustomerRegistration($customerTransfer);

        return $customerTransfer->setPassword($password);
    }

    /**
     * @return \Spryker\Zed\Mail\Business\MailFacadeInterface
     */
    protected function getMailMock(): MailFacadeInterface
    {
        return Stub::makeEmpty(MailFacadeInterface::class);
    }

    /**
     * @return \Spryker\Zed\Customer\Business\CustomerFacadeInterface
     */
    protected function getCustomerFacade(): CustomerFacadeInterface
    {
        return $this->getLocator()->customer()->facade();
    }

    /**
     * @return \Codeception\Module\WebDriver
     */
    protected function getWebDriver(): WebDriver
    {
        return $this->getModule('WebDriver');
    }

    /**
     * @return void
     */
    protected function setupSession(): void
    {
        $sessionContainer = new Session(new MockArraySessionStorage());
        $sessionClient = new SessionClient();
        $sessionClient->setContainer($sessionContainer);
    }
}
