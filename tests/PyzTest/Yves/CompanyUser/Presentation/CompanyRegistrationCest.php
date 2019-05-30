<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\CompanyUser\Presentation;

use PyzTest\Yves\CompanyUser\_support\PageObject\CompanyRegistrationPage;
use PyzTest\Yves\CompanyUser\CompanyUserPresentationTester;
use PyzTest\Yves\Customer\PageObject\CustomerLoginPage;

/**
 * Auto-generated group annotations
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
    public function testICanOpenRegistrationPage(CompanyUserPresentationTester $i): void
    {
        $i->amOnPage(CompanyRegistrationPage::URL);
        $i->see(CompanyRegistrationPage::TITLE_CREATE_ACCOUNT);
    }

    /**
     * @param \PyzTest\Yves\CompanyUser\CompanyUserPresentationTester $i
     *
     * @return void
     */
    public function testICanRegisterWithValidData(CompanyUserPresentationTester $i): void
    {
        $i->amOnPage(CompanyRegistrationPage::URL);

        $i->fillOutCompanyRegistrationForm();
        $i->click(CompanyRegistrationPage::BUTTON_REGISTER);

        $i->seeCurrentUrlEquals(CustomerLoginPage::URL);
        $i->seeInSource(CompanyRegistrationPage::SUCCESS_MESSAGE);
    }
}
