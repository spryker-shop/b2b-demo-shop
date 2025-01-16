<?php



declare(strict_types = 1);

namespace Pyz\Zed\BusinessOnBehalfGui;

use Spryker\Zed\BusinessOnBehalfGui\BusinessOnBehalfGuiDependencyProvider as SprykerBusinessOnBehalfGuiDependencyProvider;
use Spryker\Zed\CompanyRoleGui\Communication\Plugin\BusinessOnBehalfGui\CompanyRoleCustomerBusinessUnitAttachFormExpanderPlugin;

class BusinessOnBehalfGuiDependencyProvider extends SprykerBusinessOnBehalfGuiDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\BusinessOnBehalfGuiExtension\Dependency\Plugin\CustomerBusinessUnitAttachFormExpanderPluginInterface>
     */
    protected function getCustomerBusinessUnitAttachFormExpanderPlugins(): array
    {
        return [
            new CompanyRoleCustomerBusinessUnitAttachFormExpanderPlugin(),
        ];
    }
}
