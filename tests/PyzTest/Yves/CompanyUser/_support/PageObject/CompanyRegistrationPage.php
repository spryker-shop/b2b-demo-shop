<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\CompanyUser\_support\PageObject;

class CompanyRegistrationPage
{
    public const URL = '/company/register';

    public const TITLE_CREATE_ACCOUNT = 'Create account';

    public const BUTTON_REGISTER = 'Register';

    public const FORM_FIELD_SELECTOR_SALUTATION = 'company_register_form[salutation]';
    public const FORM_FIELD_SELECTOR_FIRST_NAME = 'company_register_form[first_name]';
    public const FORM_FIELD_SELECTOR_LAST_NAME = 'company_register_form[last_name]';

    public const FORM_FIELD_SELECTOR_COMPANY_NAME = 'company_register_form[company_name]';

    public const FORM_FIELD_SELECTOR_EMAIL = 'company_register_form[email]';
    public const FORM_FIELD_SELECTOR_PASSWORD = 'company_register_form[password][pass]';
    public const FORM_FIELD_SELECTOR_PASSWORD_CONFIRM = 'company_register_form[password][confirm]';

    public const FORM_FIELD_SELECTOR_ACCEPT_TERMS = '#company_register_form_accept_terms';

    public const SUCCESS_MESSAGE = 'Registration Successful';

    /**
     * @return array
     */
    public static function getCompanyData(): array
    {
        return [
            static::FORM_FIELD_SELECTOR_SALUTATION => 'Mrs',
            static::FORM_FIELD_SELECTOR_FIRST_NAME => 'Registered',
            static::FORM_FIELD_SELECTOR_LAST_NAME => 'Company User',

            static::FORM_FIELD_SELECTOR_COMPANY_NAME => 'Registered Company',

            static::FORM_FIELD_SELECTOR_EMAIL => 'registered-company-user@spryker.com',
            static::FORM_FIELD_SELECTOR_PASSWORD => 'sP3yK3r%23',
            static::FORM_FIELD_SELECTOR_PASSWORD_CONFIRM => 'sP3yK3r%23',
        ];
    }
}
