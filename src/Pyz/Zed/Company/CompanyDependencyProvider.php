<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Company;

use Spryker\Zed\Company\CompanyDependencyProvider as SprykerCompanyDependencyProvider;
use Spryker\Zed\CompanyBusinessUnit\Communication\Plugin\CompanyBusinessUnitCreatePlugin;
use Spryker\Zed\CompanyRole\Communication\Plugin\CompanyRoleCreatePlugin;
use Spryker\Zed\CompanyUser\Communication\Plugin\CompanyUserCreatePlugin;

class CompanyDependencyProvider extends SprykerCompanyDependencyProvider
{
    /**
     * @return \Spryker\Zed\Company\Dependency\Plugin\CompanyPostCreatePluginInterface[]
     */
    protected function getCompanyPostCreatePlugins(): array
    {
        return [
            new CompanyUserCreatePlugin(),
            new CompanyBusinessUnitCreatePlugin(),
            new CompanyRoleCreatePlugin(),
        ];
    }
}
