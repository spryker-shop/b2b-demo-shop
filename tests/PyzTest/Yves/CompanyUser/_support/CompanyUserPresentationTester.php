<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\CompanyUser;

use Codeception\Actor;
use PyzTest\Yves\CompanyUser\_support\PageObject\CompanyRegistrationPage;

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
 * @SuppressWarnings(\PyzTest\Yves\CompanyUser\PHPMD)
 */
class CompanyUserPresentationTester extends Actor
{
    use _generated\CompanyUserPresentationTesterActions;

    /**
     * @return void
     */
    public function fillOutCompanyRegistrationForm(): void
    {
        $i = $this;
        $companyData = CompanyRegistrationPage::getCompanyData();

        $i->selectOption(CompanyRegistrationPage::FORM_FIELD_SALUTATION, $companyData[CompanyRegistrationPage::FORM_FIELD_SALUTATION]);
        $i->fillField(CompanyRegistrationPage::FORM_FIELD_FIRST_NAME, $companyData[CompanyRegistrationPage::FORM_FIELD_FIRST_NAME]);
        $i->fillField(CompanyRegistrationPage::FORM_FIELD_LAST_NAME, $companyData[CompanyRegistrationPage::FORM_FIELD_LAST_NAME]);
        $i->fillField(CompanyRegistrationPage::FORM_FIELD_COMPANY_NAME, $companyData[CompanyRegistrationPage::FORM_FIELD_COMPANY_NAME]);
        $i->fillField(CompanyRegistrationPage::FORM_FIELD_EMAIL, $companyData[CompanyRegistrationPage::FORM_FIELD_EMAIL]);
        $i->fillField(CompanyRegistrationPage::FORM_FIELD_PASSWORD, $companyData[CompanyRegistrationPage::FORM_FIELD_PASSWORD]);
        $i->fillField(CompanyRegistrationPage::FORM_FIELD_PASSWORD_CONFIRM, $companyData[CompanyRegistrationPage::FORM_FIELD_PASSWORD_CONFIRM]);
        $i->click(CompanyRegistrationPage::FORM_FIELD_ACCEPT_TERMS);
    }
}
