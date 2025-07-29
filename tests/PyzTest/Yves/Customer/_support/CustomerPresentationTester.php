<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Yves\Customer;

use Codeception\Actor;
use Codeception\Step\Assertion;
use PyzTest\Yves\Customer\PageObject\CustomerLoginPage;
use PyzTest\Yves\Customer\PageObject\CustomerOverviewPage;
use PyzTest\Yves\Customer\PageObject\CustomerRegistrationPage;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(\PyzTest\Yves\Customer\PHPMD)
 */
class CustomerPresentationTester extends Actor
{
    use _generated\CustomerPresentationTesterActions;

    /**
     * @var string
     */
    protected const URL_STORE_PREFIX = '/DE';

    /**
     * @param string $email
     * @param string $password
     *
     * @return void
     */
    public function submitLoginForm(string $email, string $password): void
    {
        $i = $this;
        $i->submitForm(['name' => 'loginForm'], [
            CustomerLoginPage::FORM_FIELD_SELECTOR_EMAIL => $email,
            CustomerLoginPage::FORM_FIELD_SELECTOR_PASSWORD => $password,
        ]);
    }

    /**
     * @return void
     */
    public function fillOutRegistrationForm(): void
    {
        $i = $this;
        $customerTransfer = CustomerRegistrationPage::getCustomerData(CustomerRegistrationPage::NEW_CUSTOMER_EMAIL);

        $i->selectOption(CustomerRegistrationPage::FORM_FIELD_SELECTOR_SALUTATION, $customerTransfer->getSalutation());
        $i->fillField(CustomerRegistrationPage::FORM_FIELD_SELECTOR_FIRST_NAME, $customerTransfer->getFirstName());
        $i->fillField(CustomerRegistrationPage::FORM_FIELD_SELECTOR_LAST_NAME, $customerTransfer->getLastName());
        $i->fillField(CustomerRegistrationPage::FORM_FIELD_SELECTOR_EMAIL, $customerTransfer->getEmail());
        $i->fillField(CustomerRegistrationPage::FORM_FIELD_SELECTOR_PASSWORD, $customerTransfer->getPassword());
        $i->fillField(CustomerRegistrationPage::FORM_FIELD_SELECTOR_PASSWORD_CONFIRM, $customerTransfer->getPassword());
        $i->click(CustomerRegistrationPage::FORM_FIELD_SELECTOR_ACCEPT_TERMS);
    }

    /**
     * @param string $uri
     *
     * @return void
     */
    public function seeCurrentUrlEquals(string $uri): void
    {
        if ($this->getLocator()->store()->facade()->isDynamicStoreEnabled() === true) {
            $uri = sprintf('%s%s', static::URL_STORE_PREFIX, $uri);
        }

        $this->getScenario()->runStep(new Assertion('seeCurrentUrlEquals', func_get_args()));
    }

    /**
     * @return string
     */
    public function getLinkToProfilePage(): string
    {
        if ($this->getLocator()->store()->facade()->isDynamicStoreEnabled() === true) {
            return CustomerOverviewPage::DMS_LINK_TO_PROFILE_PAGE;
        }

        return CustomerOverviewPage::LINK_TO_PROFILE_PAGE;
    }

    /**
     * @return string
     */
    public function getLinkToAddressesPage(): string
    {
        if ($this->getLocator()->store()->facade()->isDynamicStoreEnabled() === true) {
            return CustomerOverviewPage::DMS_LINK_TO_ADDRESSES_PAGE;
        }

        return CustomerOverviewPage::LINK_TO_ADDRESSES_PAGE;
    }

    /**
     * @return string
     */
    public function getLinkToOrdersPage(): string
    {
        if ($this->getLocator()->store()->facade()->isDynamicStoreEnabled() === true) {
            return CustomerOverviewPage::DMS_LINK_TO_ORDERS_PAGE;
        }

        return CustomerOverviewPage::LINK_TO_ORDERS_PAGE;
    }

    /**
     * @return string
     */
    public function getLinkToNewsletterPage(): string
    {
        if ($this->getLocator()->store()->facade()->isDynamicStoreEnabled() === true) {
            return CustomerOverviewPage::DMS_LINK_TO_NEWSLETTER_PAGE;
        }

        return CustomerOverviewPage::LINK_TO_NEWSLETTER_PAGE;
    }
}
