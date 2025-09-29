<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\CustomerPage;

use SprykerShop\Yves\CustomerPage\CustomerPageConfig as SprykerCustomerPageConfig;

class CustomerPageConfig extends SprykerCustomerPageConfig
{
    protected const CUSTOMER_SECURITY_BLOCKER_ENABLED = true;

    protected const MIN_LENGTH_CUSTOMER_PASSWORD = 12;

    protected const MAX_LENGTH_CUSTOMER_PASSWORD = 128;

    protected const IS_ORDER_HISTORY_SEARCH_ENABLED = true;

    protected const PASSWORD_VALIDATION_PATTERN = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()\_\-\=\+\[\]\{\}\|;:<>.,\/?\\~])[A-Za-z\d!@#$%^&*()\_\-\=\+\[\]\{\}\|;:<>.,\/?\\~]+$/';

    protected const PASSWORD_VALIDATION_MESSAGE = 'global.password.invalid_password';

    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function isDoubleOptInEnabled(): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @deprecated Will be removed without replacement. If the future the locale-specific URL will be used.
     *
     * @return bool
     */
    public function isLocaleInLoginCheckPath(): bool
    {
        return true;
    }

    public function isRememberMeEnabled(): bool
    {
        return false;
    }

    /**
     * Specification:
     * - Returns the pattern for customer password validation.
     *
     * @api
     */
    public function getCustomerPasswordPattern(): string
    {
        return static::PASSWORD_VALIDATION_PATTERN;
    }

    /**
     * Specification:
     * - Returns the message for customer password validation.
     *
     * @api
     */
    public function getPasswordValidationMessage(): string
    {
        return static::PASSWORD_VALIDATION_MESSAGE;
    }
}
