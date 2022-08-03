<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\Customer\PageObject;

class CustomerProfilePage
{
    public const URL = '/en/customer/profile';

    public const FORM_FIELD_SELECTOR_SALUTATION = '//select[@name="profileForm[salutation]"]';
    public const FORM_FIELD_SELECTOR_FIRST_NAME = '//input[@name="profileForm[first_name]"]';
    public const FORM_FIELD_SELECTOR_LAST_NAME = '//input[@name="profileForm[last_name]"]';
    public const FORM_FIELD_SELECTOR_EMAIL = '//input[@name="profileForm[email]"]';

    public const FORM_FIELD_SELECTOR_PASSWORD = '//input[@name="profileForm[password][pass]"]';
    public const FORM_FIELD_SELECTOR_PASSWORD_CONFIRM = '//input[@name="profileForm[password][confirm]"]';

    public const BUTTON_PROFILE_FORM_SUBMIT_SELECTOR = ['name' => 'profileForm'];
    public const BUTTON_PROFILE_FORM_SUBMIT_TEXT = 'Submit';

    public const SUCCESS_MESSAGE = 'Profile was successfully saved';
    public const ERROR_MESSAGE_EMAIL = 'If this E-mail address is already in use, you will receive a password reset link. Otherwise, you must first validate your E-mail address to finish registration. Please check your E-mail.';

    public const FORM_FIELD_CHANGE_PASSWORD_SELECTOR_PASSWORD = '//input[@name="passwordForm[password]"]';
    public const FORM_FIELD_CHANGE_PASSWORD_SELECTOR_NEW_PASSWORD = '//input[@name="passwordForm[new_password][password]"]';

    public const FORM_FIELD_CHANGE_PASSWORD_SELECTOR_NEW_PASSWORD_CONFIRM = '//input[@name="passwordForm[new_password][confirm]"]';
    public const BUTTON_PROFILE_FORM_CHANGE_PASSWORD_SUBMIT_SELECTOR = '//form[@name="passwordForm"]//button[@data-qa="submit-button"]';

    public const BUTTON_PROFILE_FORM_CHANGE_PASSWORD_SUBMIT_TEXT = 'Submit';

    public const SUCCESS_MESSAGE_CHANGE_PASSWORD = 'Password change successful';
    public const ERROR_MESSAGE_CHANGE_PASSWORD = 'Passwords don\'t match';
}
