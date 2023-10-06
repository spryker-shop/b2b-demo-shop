<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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
