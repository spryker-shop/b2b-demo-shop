<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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
