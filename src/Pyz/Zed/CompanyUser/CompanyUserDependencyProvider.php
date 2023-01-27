<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyUser;

use Spryker\Zed\CompanyBusinessUnit\Communication\Plugin\CompanyUser\AssignDefaultBusinessUnitToCompanyUserPlugin;
use Spryker\Zed\CompanyBusinessUnit\Communication\Plugin\CompanyUser\CheckCompanyUserUniquenessCompanyUserSavePreCheckPlugin;
use Spryker\Zed\CompanyBusinessUnit\Communication\Plugin\CompanyUser\CompanyBusinessUnitHydratePlugin;
use Spryker\Zed\CompanyRole\Communication\Plugin\CompanyUser\AssignDefaultCompanyUserRolePlugin;
use Spryker\Zed\CompanyRole\Communication\Plugin\CompanyUser\AssignRolesCompanyUserPostCreatePlugin;
use Spryker\Zed\CompanyRole\Communication\Plugin\CompanyUser\AssignRolesCompanyUserPostSavePlugin;
use Spryker\Zed\CompanyRole\Communication\Plugin\CompanyUser\CompanyRoleCollectionHydratePlugin;
use Spryker\Zed\CompanyUser\CompanyUserDependencyProvider as SprykerCompanyUserDependencyProvider;
use Spryker\Zed\MerchantRelationship\Communication\Plugin\CompanyUser\MerchantRelationshipHydratePlugin;
use Spryker\Zed\QuoteRequest\Communication\Plugin\CompanyUserExtension\QuoteRequestCompanyUserPreDeletePlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\CompanyUserExtension\SharedCartCompanyUserPreDeletePlugin;
use Spryker\Zed\ShoppingList\Communication\Plugin\CompanyUserExtension\ShoppingListCompanyUserPreDeletePlugin;

class CompanyUserDependencyProvider extends SprykerCompanyUserDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserHydrationPluginInterface>
     */
    protected function getCompanyUserHydrationPlugins(): array
    {
        return [
            new CompanyBusinessUnitHydratePlugin(),
            new MerchantRelationshipHydratePlugin(),
            new CompanyRoleCollectionHydratePlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserPostCreatePluginInterface>
     */
    protected function getCompanyUserPostCreatePlugins(): array
    {
        return [
            new AssignRolesCompanyUserPostCreatePlugin(),
            new AssignDefaultCompanyUserRolePlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserPreSavePluginInterface>
     */
    protected function getCompanyUserPreSavePlugins(): array
    {
        return [
            new AssignDefaultBusinessUnitToCompanyUserPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserPostSavePluginInterface>
     */
    protected function getCompanyUserPostSavePlugins(): array
    {
        return [
            new AssignRolesCompanyUserPostSavePlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserPreDeletePluginInterface>
     */
    protected function getCompanyUserPreDeletePlugins(): array
    {
        return [
            new ShoppingListCompanyUserPreDeletePlugin(),
            new SharedCartCompanyUserPreDeletePlugin(),
            new QuoteRequestCompanyUserPreDeletePlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserSavePreCheckPluginInterface>
     */
    protected function getCompanyUserSavePreCheckPlugins(): array
    {
        return [
            new CheckCompanyUserUniquenessCompanyUserSavePreCheckPlugin(),
        ];
    }
}
