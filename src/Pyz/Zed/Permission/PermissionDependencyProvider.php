<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Permission;

use Pyz\Zed\CompanyUser\Communication\Plugin\Permission\SeeCompanyMenuPermissionPlugin;
use Spryker\Client\CompanyUser\Plugin\AddCompanyUserPermissionPlugin;
use Spryker\Client\ShoppingList\Plugin\ReadShoppingListPermissionPlugin;
use Spryker\Zed\CompanyRole\Communication\Plugin\PermissionStoragePlugin;
use Spryker\Zed\CompanyUserInvitation\Communication\Plugin\Permission\ManageCompanyUserInvitationPermissionPlugin;
use Spryker\Zed\Permission\PermissionDependencyProvider as SprykerPermissionDependencyProvider;
use Spryker\Zed\SharedCart\Communication\Plugin\QuotePermissionStoragePlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\ReadSharedCartPermissionPlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\WriteSharedCartPermissionPlugin;
use Spryker\Zed\ShoppingList\Communication\Plugin\ShoppingListPermissionStoragePlugin;
use Spryker\Zed\ShoppingList\Communication\Plugin\WriteShoppingListPermissionPlugin;
use SprykerShop\Client\CheckoutPage\Plugin\PlaceOrderWithAmountUpToPermissionPlugin;
use SprykerShop\Shared\CartPage\Plugin\AddCartItemPermissionPlugin;
use SprykerShop\Shared\CartPage\Plugin\ChangeCartItemPermissionPlugin;
use SprykerShop\Shared\CartPage\Plugin\RemoveCartItemPermissionPlugin;
use SprykerShop\Shared\CompanyPage\Plugin\CompanyUserStatusChangePermissionPlugin;

class PermissionDependencyProvider extends SprykerPermissionDependencyProvider
{
    /**
     * @return \Spryker\Zed\PermissionExtension\Dependency\Plugin\PermissionStoragePluginInterface[]
     */
    protected function getPermissionStoragePlugins(): array
    {
        return [
            new QuotePermissionStoragePlugin(), #SharedCartFeature
            new ShoppingListPermissionStoragePlugin(), #ShoppingListFeature
            new PermissionStoragePlugin(),
        ];
    }

    /**
     * @return \Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface[]
     */
    protected function getPermissionPlugins()
    {
        return [
            new ReadSharedCartPermissionPlugin(), #SharedCartFeature
            new WriteSharedCartPermissionPlugin(), #SharedCartFeature
            new ReadShoppingListPermissionPlugin(), #ShoppingListFeature
            new WriteShoppingListPermissionPlugin(), #ShoppingListFeature
            new AddCompanyUserPermissionPlugin(),
            new ManageCompanyUserInvitationPermissionPlugin,
            new CompanyUserStatusChangePermissionPlugin(),
            new SeeCompanyMenuPermissionPlugin(),
            new AddCartItemPermissionPlugin(),
            new ChangeCartItemPermissionPlugin(),
            new RemoveCartItemPermissionPlugin(),
            new PlaceOrderWithAmountUpToPermissionPlugin(),
        ];
    }
}
