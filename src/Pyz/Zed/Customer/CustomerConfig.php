<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Customer;

use Spryker\Zed\Customer\CustomerConfig as SprykerCustomerConfig;

class CustomerConfig extends SprykerCustomerConfig
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCustomerViewExternalBlockUrls()
    {
        return array_merge(
            parent::getCustomerViewExternalBlockUrls(),
            [
                'notes' => '/customer-note-gui/index/index',
            ]
        );
    }
}
