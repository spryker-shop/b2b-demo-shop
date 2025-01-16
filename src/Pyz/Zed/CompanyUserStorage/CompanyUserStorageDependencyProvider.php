<?php



declare(strict_types = 1);

namespace Pyz\Zed\CompanyUserStorage;

use Spryker\Zed\CompanyBusinessUnitStorage\Communication\Plugin\CompanyBusinessUnitCompanyUserStorageExpanderPlugin;
use Spryker\Zed\CompanyUserStorage\CompanyUserStorageDependencyProvider as SprykerCompanyUserStorageDependencyProvider;

class CompanyUserStorageDependencyProvider extends SprykerCompanyUserStorageDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\CompanyUserStorageExtension\Dependency\Plugin\CompanyUserStorageExpanderPluginInterface>
     */
    protected function getCompanyUserStorageExpanderPlugins(): array
    {
        return [
            new CompanyBusinessUnitCompanyUserStorageExpanderPlugin(),
        ];
    }
}
