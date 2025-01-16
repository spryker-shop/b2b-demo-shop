<?php



declare(strict_types = 1);

namespace Pyz\Glue\ShipmentsRestApi;

use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Plugin\ShipmentsRestApi\CompanyBusinessUnitAddressSourceCheckerPlugin;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Plugin\ShipmentsRestApi\CompanyBusinessUnitUuidRestAddressResponseMapperPlugin;
use Spryker\Glue\CustomersRestApi\Plugin\ShipmentsRestApi\CustomerAddressSourceCheckerPlugin;
use Spryker\Glue\ShipmentsRestApi\ShipmentsRestApiDependencyProvider as SprykerShipmentsRestApiDependencyProvider;

class ShipmentsRestApiDependencyProvider extends SprykerShipmentsRestApiDependencyProvider
{
    /**
     * @return array<\Spryker\Glue\ShipmentsRestApiExtension\Dependency\Plugin\AddressSourceCheckerPluginInterface>
     */
    protected function getAddressSourceCheckerPlugins(): array
    {
        return [
            new CompanyBusinessUnitAddressSourceCheckerPlugin(),
            new CustomerAddressSourceCheckerPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Glue\ShipmentsRestApiExtension\Dependency\Plugin\RestAddressResponseMapperPluginInterface>
     */
    protected function getRestAddressResponseMapperPlugins(): array
    {
        return [
            new CompanyBusinessUnitUuidRestAddressResponseMapperPlugin(),
        ];
    }
}
