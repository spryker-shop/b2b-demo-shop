<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Customer;

use Spryker\Zed\Customer\CustomerConfig as SprykerCustomerConfig;

class CustomerConfig extends SprykerCustomerConfig
{
    /**
     * {@inheritDoc}
     *
     * @return string[]
     */
    public function getCustomerDetailExternalBlocksUrls()
    {
        return [
            'sales' => '/sales/customer/customer-orders',
            'notes' => '/customer-note-gui/index/index',
        ] + parent::getCustomerDetailExternalBlocksUrls();
    }

    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function isDoubleOptInEnabled(): bool
    {
        return true;
    }
}
