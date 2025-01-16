<?php



declare(strict_types = 1);

namespace Pyz\Zed\CompanyUnitAddress;

use Spryker\Zed\CompanyUnitAddress\CompanyUnitAddressDependencyProvider as SprykerCompanyUnitAddressDependencyProvider;
use Spryker\Zed\CompanyUnitAddressLabel\Communication\Plugin\CompanyUnitAddressPostSavePlugin;

class CompanyUnitAddressDependencyProvider extends SprykerCompanyUnitAddressDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\CompanyUnitAddressExtension\Dependency\Plugin\CompanyUnitAddressPostSavePluginInterface>
     */
    protected function getCompanyUnitAddressPostSavePlugins(): array
    {
        return [
            new CompanyUnitAddressPostSavePlugin(),
        ];
    }
}
