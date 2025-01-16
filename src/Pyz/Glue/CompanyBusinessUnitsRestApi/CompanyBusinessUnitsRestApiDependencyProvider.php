<?php



declare(strict_types = 1);

namespace Pyz\Glue\CompanyBusinessUnitsRestApi;

use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Plugin\CompanyBusinessUnitsRestApi\DefaultBillingAddressMapperPlugin;
use Spryker\Glue\CompanyBusinessUnitsRestApi\CompanyBusinessUnitsRestApiDependencyProvider as SprykerCompanyBusinessUnitsRestApiDependencyProvider;

class CompanyBusinessUnitsRestApiDependencyProvider extends SprykerCompanyBusinessUnitsRestApiDependencyProvider
{
    /**
     * @return array<\Spryker\Glue\CompanyBusinessUnitsRestApiExtension\Dependency\Plugin\CompanyBusinessUnitMapperPluginInterface>
     */
    protected function getCompanyBusinessUnitMapperPlugins(): array
    {
        return [
            new DefaultBillingAddressMapperPlugin(),
        ];
    }
}
