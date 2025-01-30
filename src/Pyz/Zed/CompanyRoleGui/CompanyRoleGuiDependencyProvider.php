<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\CompanyRoleGui;

use Spryker\Zed\CompanyGui\Communication\Plugin\CompanyRoleGui\CompanyToCompanyRoleCreateFormExpanderPlugin;
use Spryker\Zed\CompanyRoleGui\CompanyRoleGuiDependencyProvider as SprykerCompanyRoleGuiDependencyProvider;

class CompanyRoleGuiDependencyProvider extends SprykerCompanyRoleGuiDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\CompanyRoleGuiExtension\Communication\Plugin\CompanyRoleCreateFormExpanderPluginInterface>
     */
    protected function getCompanyRoleCreateFormExpanderPlugins(): array
    {
        return [
            new CompanyToCompanyRoleCreateFormExpanderPlugin(), new CompanyToCompanyRoleCreateFormExpanderPlugin(),
        ];
    }
}
