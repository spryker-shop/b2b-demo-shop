<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyUnitAddressGui;

use Spryker\Zed\CompanyUnitAddressGui\CompanyUnitAddressGuiDependencyProvider as SprykerCompanyUnitAddressGuiDependencyProvider;
use Spryker\Zed\CompanyUnitAddressLabel\Communication\Plugin\CompanyUnitAddressEditFormExpanderPlugin;

class CompanyUnitAddressGuiDependencyProvider extends SprykerCompanyUnitAddressGuiDependencyProvider
{
    /**
     * @return \Spryker\Zed\CompanyUnitAddressGuiExtension\Dependency\Plugin\CompanyUnitAddressEditFormExpanderPluginInterface[]
     */
    protected function getCompanyUnitAddressFormPlugins(): array
    {
        return [
            new CompanyUnitAddressEditFormExpanderPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\CompanyUnitAddressGuiExtension\Dependency\Plugin\CompanyUnitAddressTableConfigExpanderPluginInterface[]
     */
    protected function getCompanyUnitAddressTableConfigExpanderPlugins(): array
    {
        return [
        ];
    }

    /**
     * @return \Spryker\Zed\CompanyUnitAddressGuiExtension\Dependency\Plugin\CompanyUnitAddressTableHeaderExpanderPluginInterface[]
     */
    protected function getCompanyUnitAddressTableHeaderExpanderPlugins(): array
    {
        return [
        ];
    }

    /**
     * @return \Spryker\Zed\CompanyUnitAddressGuiExtension\Dependency\Plugin\CompanyUnitAddressTableDataExpanderPluginInterface[]
     */
    protected function getCompanyUnitAddressTableDataExpanderPlugins(): array
    {
        return [
        ];
    }
}
