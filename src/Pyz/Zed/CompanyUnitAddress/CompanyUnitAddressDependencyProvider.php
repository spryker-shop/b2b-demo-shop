<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyUnitAddress;

use Spryker\Zed\CompanyUnitAddress\CompanyUnitAddressDependencyProvider as SprykerCompanyUnitAddressDependencyProvider;
use Spryker\Zed\CompanyUnitAddressLabel\Communication\Plugin\CompanyUnitAddressPostSavePlugin;

class CompanyUnitAddressDependencyProvider extends SprykerCompanyUnitAddressDependencyProvider
{
    /**
     * @return \Spryker\Zed\CompanyUnitAddressExtension\Dependency\Plugin\CompanyUnitAddressPostSavePluginInterface[]
     */
    protected function getCompanyUnitAddressPostSavePlugins(): array
    {
        return [
            new CompanyUnitAddressPostSavePlugin(),
        ];
    }
}
