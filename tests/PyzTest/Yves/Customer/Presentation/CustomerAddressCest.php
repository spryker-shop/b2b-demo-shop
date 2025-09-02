<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Yves\Customer\Presentation;

use Codeception\Scenario;
use PyzTest\Yves\Customer\CustomerPresentationTester;
use PyzTest\Yves\Customer\PageObject\CustomerAddressesPage;
use PyzTest\Yves\Customer\PageObject\CustomerAddressPage;

/**
 * @skip This test was temporarily skipped due to flikerness. See {@link https://spryker.atlassian.net/browse/CC-35660} for details
 *
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Yves
 * @group Customer
 * @group Presentation
 * @group CustomerAddressCest
 * Add your own group annotations below this line
 */
class CustomerAddressCest
{
    /**
     * @param \PyzTest\Yves\Customer\CustomerPresentationTester $i
     *
     * @return void
     */
    public function _before(CustomerPresentationTester $i): void
    {
        $i->amYves();
    }

    /**
     * @param \PyzTest\Yves\Customer\CustomerPresentationTester $i
     * @param \Codeception\Scenario $scenario
     *
     * @return void
     */
    public function testICanAddNewAddress(CustomerPresentationTester $i, Scenario $scenario): void // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        $i->amLoggedInCustomer();
        $i->wait(5);
        $i->amOnPage(CustomerAddressPage::URL);

        $addressTransfer = CustomerAddressesPage::getAddressData(CustomerAddressesPage::ADDRESS_A);

        $i->selectOption(CustomerAddressPage::FORM_FIELD_SELECTOR_SALUTATION, $addressTransfer->getSalutation());
        $i->fillField(CustomerAddressPage::FORM_FIELD_SELECTOR_FIRST_NAME, $addressTransfer->getFirstName());
        $i->fillField(CustomerAddressPage::FORM_FIELD_SELECTOR_LAST_NAME, $addressTransfer->getLastName());
        $i->fillField(CustomerAddressPage::FORM_FIELD_SELECTOR_COMPANY, $addressTransfer->getCompany());
        $i->fillField(CustomerAddressPage::FORM_FIELD_SELECTOR_PHONE, $addressTransfer->getPhone());
        $i->fillField(CustomerAddressPage::FORM_FIELD_SELECTOR_STREET, $addressTransfer->getAddress1());
        $i->fillField(CustomerAddressPage::FORM_FIELD_SELECTOR_NUMBER, $addressTransfer->getAddress2());
        $i->fillField(CustomerAddressPage::FORM_FIELD_SELECTOR_ADDITION_TO_ADDRESS, $addressTransfer->getAddress3());
        $i->fillField(CustomerAddressPage::FORM_FIELD_SELECTOR_CITY, $addressTransfer->getCity());
        $i->fillField(CustomerAddressPage::FORM_FIELD_SELECTOR_ZIP_CODE, $addressTransfer->getZipCode());
        $i->selectOption(CustomerAddressPage::FORM_FIELD_SELECTOR_COUNTRY, $addressTransfer->getIso2Code());

        $i->click(CustomerAddressPage::BUTTON_SUBMIT);
        $i->seeInSource(CustomerAddressPage::SUCCESS_MESSAGE);
    }
}
