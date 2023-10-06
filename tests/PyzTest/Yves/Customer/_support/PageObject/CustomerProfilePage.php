<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\Customer\PageObject;

class CustomerProfilePage
{
    /**
     * @var string
     */
    public const URL = '/en/customer/profile';

    /**
     * @var string
     */
    public const FORM_FIELD_SELECTOR_SALUTATION = '//select[@name="profileForm[salutation]"]';

    /**
     * @var string
     */
    public const FORM_FIELD_SELECTOR_FIRST_NAME = '//input[@name="profileForm[first_name]"]';

    /**
     * @var string
     */
    public const FORM_FIELD_SELECTOR_LAST_NAME = '//input[@name="profileForm[last_name]"]';

    /**
     * @var string
     */
    public const FORM_FIELD_SELECTOR_EMAIL = '//input[@name="profileForm[email]"]';

    /**
     * @var string
     */
    public const FORM_FIELD_SELECTOR_PASSWORD = '//input[@name="profileForm[password][pass]"]';

    /**
     * @var string
     */
    public const FORM_FIELD_SELECTOR_PASSWORD_CONFIRM = '//input[@name="profileForm[password][confirm]"]';

    /**
     * @var array
     */
    public const BUTTON_PROFILE_FORM_SUBMIT_SELECTOR = ['name' => 'profileForm'];

    /**
     * @var string
     */
    public const BUTTON_PROFILE_FORM_SUBMIT_TEXT = 'Submit';

    /**
     * @var string
     */
    public const SUCCESS_MESSAGE = 'Profile was successfully saved';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_EMAIL = 'If this E-mail address is already in use, you will receive a password reset link. Otherwise, you must first validate your E-mail address to finish registration. Please check your E-mail.';

    /**
     * @var string
     */
    public const FORM_FIELD_CHANGE_PASSWORD_SELECTOR_PASSWORD = '//input[@name="passwordForm[password]"]';

    /**
     * @var string
     */
    public const FORM_FIELD_CHANGE_PASSWORD_SELECTOR_NEW_PASSWORD = '//input[@name="passwordForm[new_password][password]"]';

    /**
     * @var string
     */
    public const FORM_FIELD_CHANGE_PASSWORD_SELECTOR_NEW_PASSWORD_CONFIRM = '//input[@name="passwordForm[new_password][confirm]"]';

    /**
     * @var string
     */
    public const BUTTON_PROFILE_FORM_CHANGE_PASSWORD_SUBMIT_SELECTOR = '//form[@name="passwordForm"]//button[@data-qa="submit-button"]';

    /**
     * @var string
     */
    public const BUTTON_PROFILE_FORM_CHANGE_PASSWORD_SUBMIT_TEXT = 'Submit';

    /**
     * @var string
     */
    public const SUCCESS_MESSAGE_CHANGE_PASSWORD = 'Password change successful';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_CHANGE_PASSWORD = 'Passwords don\'t match';
}
