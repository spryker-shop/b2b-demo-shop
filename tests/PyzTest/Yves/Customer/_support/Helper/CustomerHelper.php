<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

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

    public function loadCustomerByEmail(string $email): ?SpyCustomer
    {
        $customerQuery = new SpyCustomerQuery();

        return $customerQuery->findOneByEmail($email);
    }

    public function haveRegisteredCustomer(array $seed = []): CustomerTransfer
    {
        $this->setupSession();

        $customerTransfer = $this->createCustomer($seed);

        $this->getModule('\\' . CompanyUserHelper::class)
            ->haveRegisteredCompanyUser($customerTransfer)
            ->getCustomer();

        return $customerTransfer;
    }

    public function addAddressToCustomer(string $email, string $address, bool $isDefaultShipping = true, bool $isDefaultBilling = true): void
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

    public function addNewsletterSubscription(string $email, string $type = NewsletterConstants::DEFAULT_NEWSLETTER_TYPE): void
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

    protected function getMailMock(): MailFacadeInterface
    {
        return Stub::makeEmpty(MailFacadeInterface::class);
    }

    protected function getCustomerFacade(): CustomerFacadeInterface
    {
        return $this->getLocator()->customer()->facade();
    }

    protected function getWebDriver(): WebDriver
    {
        return $this->getModule('WebDriver');
    }

    protected function setupSession(): void
    {
        $sessionContainer = new Session(new MockArraySessionStorage());
        $sessionClient = new SessionClient();
        $sessionClient->setContainer($sessionContainer);
    }
}
