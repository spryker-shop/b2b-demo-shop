<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyRoleGui;

use Spryker\Zed\CompanyRoleGui\CompanyRoleGuiDependencyProvider as SprykerCompanyRoleGuiDependencyProvider;

class CompanyRoleGuiDependencyProvider extends SprykerCompanyRoleGuiDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\CompanyRoleGuiExtension\Communication\Plugin\CompanyRoleCreateFormExpanderPluginInterface>
     */
    protected function getCompanyRoleCreateFormExpanderPlugins() : array
    {
        return [
            new Spryker\Zed\CompanyGui\Communication\Plugin\CompanyRoleGui\CompanyToCompanyRoleCreateFormExpanderPlugin(), new Spryker\Zed\CompanyGui\Communication\Plugin\CompanyRoleGui\CompanyToCompanyRoleCreateFormExpanderPlugin(),
        ];
    }
}