<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Yves\Newsletter\PageObject;

class NewsletterSubscriptionHomePage
{
    public const NEW_EMAIL = 'foo@bar.com';

    public const EXISTING_EMAIL = 'bar@foo.com';

    public const FORM_FIELD_EMAIL = '//form[@name=\'newsletterSubscriptionWidgetForm\']//input[@type=\'email\']';

    public const FORM_BUTTON_SUBMIT = 'button[data-qa=\'submit-button\']';

    public const ERROR_MESSAGE = 'You are already subscribed to the newsletter';

    public const SUCCESS_MESSAGE = 'You successfully subscribed to the newsletter';
}
