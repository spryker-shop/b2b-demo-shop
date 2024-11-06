<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\CompanyUser\Presentation;

use Codeception\Scenario;
use PyzTest\Yves\CompanyUser\_support\PageObject\CompanyRegistrationPage;
use PyzTest\Yves\CompanyUser\CompanyUserPresentationTester;
use PyzTest\Yves\Customer\PageObject\CustomerLoginPage;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Yves
 * @group CompanyUser
 * @group Presentation
 * @group CompanyRegistrationCest
 * Add your own group annotations below this line
 */
class CompanyRegistrationCest
{
    /**
     * @param \PyzTest\Yves\CompanyUser\CompanyUserPresentationTester $i
     *
     * @return void
     */
    public function _before(CompanyUserPresentationTester $i): void
    {
        $i->amYves();
    }

    /**
     * @param \PyzTest\Yves\CompanyUser\CompanyUserPresentationTester $i
     *
     * @return void
     */
    public function testICanOpenRegistrationPage(CompanyUserPresentationTester $i): void
    {
        $i->amOnPage(CompanyRegistrationPage::URL);
        $i->see(CompanyRegistrationPage::TITLE_CREATE_ACCOUNT);
    }

    /**
     * @param \PyzTest\Yves\CompanyUser\CompanyUserPresentationTester $i
     * @param \Codeception\Scenario $scenario
     *
     * @return void
     */
    public function testICanRegisterWithValidData(CompanyUserPresentationTester $i, Scenario $scenario): void
    {
        $scenario->skip('Test is broken due to improper usage of checkbox check/uncheck functions.');

        $i->amOnPage(CompanyRegistrationPage::URL);

        $i->fillOutCompanyRegistrationForm();
        $i->click(CompanyRegistrationPage::FORM_BUTTON_SUBMIT);

        $i->seeCurrentUrlEquals(CustomerLoginPage::URL);
        $i->seeInSource(CompanyRegistrationPage::MESSAGE_SUCCESS_COMPANY_REGISTERED);
    }
}
