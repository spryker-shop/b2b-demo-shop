<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\Customer\Presentation;

use Generated\Shared\DataBuilder\CustomerBuilder;
use PyzTest\Yves\Customer\CustomerPresentationTester;
use PyzTest\Yves\Customer\PageObject\CustomerProfilePage;

/**
 * Auto-generated group annotations
 * @group PyzTest
 * @group Yves
 * @group Customer
 * @group Presentation
 * @group CustomerProfileCest
 * Add your own group annotations below this line
 */
class CustomerProfileCest
{
    /**
     * @param \PyzTest\Yves\Customer\CustomerPresentationTester $i
     *
     * @return void
     */
    public function testICanUpdateProfileData(CustomerPresentationTester $i): void
    {
        $i->amLoggedInCustomer();
        $i->amOnPage(CustomerProfilePage::URL);

        $newCustomerTransfer = (new CustomerBuilder())->build();

        $i->selectOption(CustomerProfilePage::FORM_FIELD_SELECTOR_SALUTATION, $newCustomerTransfer->getSalutation());
        $i->fillField(CustomerProfilePage::FORM_FIELD_SELECTOR_FIRST_NAME, $newCustomerTransfer->getFirstName());
        $i->fillField(CustomerProfilePage::FORM_FIELD_SELECTOR_LAST_NAME, $newCustomerTransfer->getLastName());
        $i->click(CustomerProfilePage::BUTTON_PROFILE_FORM_SUBMIT_TEXT, CustomerProfilePage::BUTTON_PROFILE_FORM_SUBMIT_SELECTOR);

        $i->seeInSource(CustomerProfilePage::SUCCESS_MESSAGE);
    }

    /**
     * @param \PyzTest\Yves\Customer\CustomerPresentationTester $i
     *
     * @return void
     */
    public function testICanUpdateEmail(CustomerPresentationTester $i): void
    {
        $i->amLoggedInCustomer();
        $i->amOnPage(CustomerProfilePage::URL);

        $newCustomerEmail = (new CustomerBuilder())->build()->getEmail();

        $i->fillField(CustomerProfilePage::FORM_FIELD_SELECTOR_EMAIL, $newCustomerEmail);
        $i->click(CustomerProfilePage::BUTTON_PROFILE_FORM_SUBMIT_TEXT, CustomerProfilePage::BUTTON_PROFILE_FORM_SUBMIT_SELECTOR);

        $i->seeInSource(CustomerProfilePage::SUCCESS_MESSAGE);
    }

    /**
     * @param \PyzTest\Yves\Customer\CustomerPresentationTester $i
     *
     * @return void
     */
    public function testICanNotUpdateEmailToAnAlreadyUsedOne(CustomerPresentationTester $i): void
    {
        $i->amLoggedInCustomer();
        $anotherCustomerTransfer = $i->haveRegisteredCustomer();

        $i->amOnPage(CustomerProfilePage::URL);

        $i->fillField(CustomerProfilePage::FORM_FIELD_SELECTOR_EMAIL, $anotherCustomerTransfer->getEmail());
        $i->click(CustomerProfilePage::BUTTON_PROFILE_FORM_SUBMIT_TEXT, CustomerProfilePage::BUTTON_PROFILE_FORM_SUBMIT_SELECTOR);

        $i->seeInSource(CustomerProfilePage::ERROR_MESSAGE_EMAIL);
    }

    /**
     * @param \PyzTest\Yves\Customer\CustomerPresentationTester $i
     *
     * @return void
     */
    public function testICanChangePassword(CustomerPresentationTester $i): void
    {
        $customerTransfer = $i->amLoggedInCustomer();
        $i->amOnPage(CustomerProfilePage::URL);

        $oldPassword = $customerTransfer->getPassword();
        $newPassword = strrev($oldPassword);

        $i->fillField(CustomerProfilePage::FORM_FIELD_CHANGE_PASSWORD_SELECTOR_PASSWORD, $oldPassword);
        $i->fillField(CustomerProfilePage::FORM_FIELD_CHANGE_PASSWORD_SELECTOR_NEW_PASSWORD, $newPassword);
        $i->fillField(CustomerProfilePage::FORM_FIELD_CHANGE_PASSWORD_SELECTOR_NEW_PASSWORD_CONFIRM, $newPassword);
        $i->click(CustomerProfilePage::BUTTON_PROFILE_FORM_CHANGE_PASSWORD_SUBMIT_SELECTOR);

        $i->seeInSource(CustomerProfilePage::SUCCESS_MESSAGE_CHANGE_PASSWORD);
    }

    /**
     * @param \PyzTest\Yves\Customer\CustomerPresentationTester $i
     *
     * @return void
     */
    public function testICanNotChangePasswordWhenNewPasswordsNotMatch(CustomerPresentationTester $i): void
    {
        $customerTransfer = $i->amLoggedInCustomer();
        $i->amOnPage(CustomerProfilePage::URL);

        $oldPassword = $customerTransfer->getPassword();
        $newPassword = strrev($oldPassword);

        $i->fillField(CustomerProfilePage::FORM_FIELD_CHANGE_PASSWORD_SELECTOR_PASSWORD, $oldPassword);
        $i->fillField(CustomerProfilePage::FORM_FIELD_CHANGE_PASSWORD_SELECTOR_NEW_PASSWORD, $newPassword);
        $i->fillField(CustomerProfilePage::FORM_FIELD_CHANGE_PASSWORD_SELECTOR_NEW_PASSWORD_CONFIRM, 'not matching password');
        $i->click(CustomerProfilePage::BUTTON_PROFILE_FORM_CHANGE_PASSWORD_SUBMIT_SELECTOR);

        $i->seeInSource(CustomerProfilePage::ERROR_MESSAGE_CHANGE_PASSWORD);
    }
}
