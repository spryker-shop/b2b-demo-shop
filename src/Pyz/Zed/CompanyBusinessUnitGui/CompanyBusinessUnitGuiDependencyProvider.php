<?php



declare(strict_types = 1);

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
