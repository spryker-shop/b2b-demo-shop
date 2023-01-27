<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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
