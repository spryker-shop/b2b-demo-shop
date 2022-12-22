<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\CompanyUser\_support\PageObject;

class CompanyRegistrationPage
{
    /**
     * @var string
     */
    public const URL = '/company/register';

    /**
     * @var string
     */
    public const TITLE_CREATE_ACCOUNT = 'Create account';

    /**
     * @var string
     */
    public const FORM_FIELD_SALUTATION = '//form[@name=\'company_register_form\']//select[@name=\'company_register_form[salutation]\']';

    /**
     * @var string
     */
    public const FORM_FIELD_FIRST_NAME = '//form[@name=\'company_register_form\']//input[@name=\'company_register_form[first_name]\']';

    /**
     * @var string
     */
    public const FORM_FIELD_LAST_NAME = '//form[@name=\'company_register_form\']//input[@name=\'company_register_form[last_name]\']';

    /**
     * @var string
     */
    public const FORM_FIELD_COMPANY_NAME = '//form[@name=\'company_register_form\']//input[@name=\'company_register_form[company_name]\']';

    /**
     * @var string
     */
    public const FORM_FIELD_EMAIL = '//form[@name=\'company_register_form\']//input[@name=\'company_register_form[email]\']';

    /**
     * @var string
     */
    public const FORM_FIELD_PASSWORD = '//form[@name=\'company_register_form\']//input[@id = \'company_register_form_password_pass\']';

    /**
     * @var string
     */
    public const FORM_FIELD_PASSWORD_CONFIRM = '//form[@name=\'company_register_form\']//input[@id = \'company_register_form_password_confirm\']';

    /**
     * @var string
     */
    public const FORM_FIELD_ACCEPT_TERMS = '//form[@name=\'company_register_form\']//input[@name=\'company_register_form[accept_terms]\']';

    /**
     * @var string
     */
    public const FORM_BUTTON_SUBMIT = '//form[@name=\'company_register_form\']//button[@type=\'submit\']';

    /**
     * @var string
     */
    public const MESSAGE_SUCCESS_COMPANY_REGISTERED = 'Registration Successful';

    /**
     * @return array
     */
    public static function getCompanyData(): array
    {
        return [
            static::FORM_FIELD_SALUTATION => 'Mrs',
            static::FORM_FIELD_FIRST_NAME => 'Registered',
            static::FORM_FIELD_LAST_NAME => 'Company User',

            static::FORM_FIELD_COMPANY_NAME => 'Registered Company',

            static::FORM_FIELD_EMAIL => 'registered-company-user@spryker.com',
            static::FORM_FIELD_PASSWORD => 'sP3yK3r%23',
            static::FORM_FIELD_PASSWORD_CONFIRM => 'sP3yK3r%23',
        ];
    }
}
