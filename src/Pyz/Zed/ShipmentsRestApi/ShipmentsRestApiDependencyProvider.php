<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ShipmentsRestApi;

use Spryker\Zed\CompanyBusinessUnitAddressesRestApi\Communication\Plugin\ShipmentsRestApi\CompanyBusinessUnitAddressProviderStrategyPlugin;
use Spryker\Zed\CustomersRestApi\Communication\Plugin\ShipmentsRestApi\CustomerAddressProviderStrategyPlugin;
use Spryker\Zed\ShipmentsRestApi\ShipmentsRestApiDependencyProvider as SprykerShipmentsRestApiDependencyProvider;

/**
 * @method \Spryker\Zed\ShipmentsRestApi\ShipmentsRestApiConfig getConfig()
 */
class ShipmentsRestApiDependencyProvider extends SprykerShipmentsRestApiDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\ShipmentsRestApiExtension\Dependency\Plugin\AddressProviderStrategyPluginInterface>
     */
    protected function getAddressProviderStrategyPlugins(): array
    {
        return [
            new CompanyBusinessUnitAddressProviderStrategyPlugin(),
            new CustomerAddressProviderStrategyPlugin(),
        ];
    }
}
