<?php



declare(strict_types = 1);

namespace Pyz\Glue\SharedCartsRestApi;

use Spryker\Glue\CompanyUserStorage\Communication\Plugin\SharedCartsRestApi\CompanyUserStorageProviderPlugin;
use Spryker\Glue\SharedCartsRestApi\SharedCartsRestApiDependencyProvider as SprykerSharedCartsRestApiDependencyProvider;
use Spryker\Glue\SharedCartsRestApiExtension\Dependency\Plugin\CompanyUserProviderPluginInterface;

class SharedCartsRestApiDependencyProvider extends SprykerSharedCartsRestApiDependencyProvider
{
    /**
     * @return \Spryker\Glue\SharedCartsRestApiExtension\Dependency\Plugin\CompanyUserProviderPluginInterface
     */
    protected function getCompanyUserProviderPlugin(): CompanyUserProviderPluginInterface
    {
        return new CompanyUserStorageProviderPlugin();
    }
}
