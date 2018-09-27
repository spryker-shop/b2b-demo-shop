<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyUser;

use Spryker\Zed\CompanyBusinessUnit\Communication\Plugin\CompanyUser\AssignDefaultBusinessUnitToCompanyUserPlugin;
use Spryker\Zed\CompanyBusinessUnit\Communication\Plugin\CompanyUser\CompanyBusinessUnitHydratePlugin;
use Spryker\Zed\CompanyRole\Communication\Plugin\CompanyUser\AssignDefaultCompanyUserRolePlugin;
use Spryker\Zed\CompanyUser\CompanyUserDependencyProvider as SprykerCompanyUserDependencyProvider;
use Spryker\Zed\MerchantRelationship\Communication\Plugin\CompanyUser\MerchantRelationshipHydratePlugin;

class CompanyUserDependencyProvider extends SprykerCompanyUserDependencyProvider
{
    /**
     * @return \Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserHydrationPluginInterface[]
     */
    protected function getCompanyUserHydrationPlugins(): array
    {
        return [
            new CompanyBusinessUnitHydratePlugin(),
            new MerchantRelationshipHydratePlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserPostCreatePluginInterface[]
     */
    protected function getCompanyUserPostCreatePlugins(): array
    {
        return [
            new AssignDefaultCompanyUserRolePlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserPreSavePluginInterface[]
     */
    protected function getCompanyUserPreSavePlugins(): array
    {
        return [
            new AssignDefaultBusinessUnitToCompanyUserPlugin(),
        ];
    }
}
