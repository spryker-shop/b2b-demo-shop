<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Customer;

use Spryker\Client\CartCustomerConnector\Plugin\CustomerChangeCartUpdatePlugin;
use Spryker\Client\Customer\Plugin\CustomerAddressSessionUpdatePlugin;
use Spryker\Client\Customer\CustomerDependencyProvider as SprykerCustomerDependencyProvider;
use Spryker\Client\Customer\Dependency\Plugin\CustomerSessionGetPluginInterface;
use Spryker\Client\Customer\Dependency\Plugin\CustomerSessionSetPluginInterface;
use Spryker\Client\Customer\Dependency\Plugin\DefaultAddressChangePluginInterface;
use Spryker\Client\Customer\Plugin\CustomerTransferRefreshPlugin;

class CustomerDependencyProvider extends SprykerCustomerDependencyProvider
{
    /**
     * @return CustomerSessionGetPluginInterface[]
     */
    protected function getCustomerSessionGetPlugins()
    {
        return [
            new CustomerTransferRefreshPlugin(),
        ];
    }

    /**
     * @return CustomerSessionSetPluginInterface[]
     */
    protected function getCustomerSessionSetPlugins()
    {
        return [
            new CustomerChangeCartUpdatePlugin(),
        ];
    }

    /**
     * @return DefaultAddressChangePluginInterface[]
     */
    protected function getDefaultAddressChangePlugins()
    {
        return [
            new CustomerAddressSessionUpdatePlugin(),
        ];
    }
}
