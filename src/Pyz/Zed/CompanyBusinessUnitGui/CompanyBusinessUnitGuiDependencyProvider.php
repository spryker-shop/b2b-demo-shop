<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyBusinessUnitGui;

use Spryker\Zed\CompanyBusinessUnitGui\CompanyBusinessUnitGuiDependencyProvider as SprykerCompanyBusinessUnitGuiDependencyProvider;
use Spryker\Zed\CompanyUnitAddressGui\Communication\Plugin\CompanyBusinessUnitGui\CompanyBusinessUnitAddressFieldPlugin;

class CompanyBusinessUnitGuiDependencyProvider extends SprykerCompanyBusinessUnitGuiDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\CompanyBusinessUnitGuiExtension\Communication\Plugin\CompanyBusinessUnitFormExpanderPluginInterface>
     */
    protected function getCompanyBusinessUnitEditFormExpanderPlugins(): array
    {
        return [
            new CompanyBusinessUnitAddressFieldPlugin(),
        ];
    }
}
