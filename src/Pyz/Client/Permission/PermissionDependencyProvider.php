<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Permission;

use Pyz\Zed\CompanyUser\Communication\Plugin\Permission\SeeCompanyMenuPermissionPlugin;
use Spryker\Client\CompanyBusinessUnitSalesConnector\Plugin\Permission\SeeBusinessUnitOrdersPermissionPlugin;
use Spryker\Client\CompanyRole\Plugin\Permission\CreateCompanyRolesPermissionPlugin;
use Spryker\Client\CompanyRole\Plugin\Permission\DeleteCompanyRolesPermissionPlugin;
use Spryker\Client\CompanyRole\Plugin\Permission\EditCompanyRolesPermissionPlugin;
use Spryker\Client\CompanyRole\Plugin\Permission\SeeCompanyRolesPermissionPlugin;
use Spryker\Client\CompanyRole\Plugin\PermissionStoragePlugin;
use Spryker\Client\CompanySalesConnector\Plugin\Permission\SeeCompanyOrdersPermissionPlugin;
use Spryker\Client\CompanyUser\Plugin\CompanyUserStatusChangePermissionPlugin;
use Spryker\Client\CompanyUser\Plugin\Permission\DeleteCompanyUsersPermissionPlugin;
use Spryker\Client\CompanyUser\Plugin\Permission\EditCompanyUsersPermissionPlugin;
use Spryker\Client\CompanyUser\Plugin\Permission\SeeCompanyUsersPermissionPlugin;
use Spryker\Client\CustomerAccessPermission\Plugin\CustomerAccessPermissionStoragePlugin;
use Spryker\Client\CustomerAccessPermission\Plugin\SeeAddToCartPermissionPlugin;
use Spryker\Client\CustomerAccessPermission\Plugin\SeeOrderPlaceSubmitPermissionPlugin;
use Spryker\Client\CustomerAccessPermission\Plugin\SeePricePermissionPlugin;
use Spryker\Client\CustomerAccessPermission\Plugin\SeeShoppingListPermissionPlugin;
use Spryker\Client\CustomerAccessPermission\Plugin\SeeWishlistPermissionPlugin;
use Spryker\Client\MerchantRelationRequest\Plugin\Permission\CreateMerchantRelationRequestPermissionPlugin;
use Spryker\Client\OauthPermission\Plugin\Permission\OauthPermissionStoragePlugin;
use Spryker\Client\Permission\PermissionDependencyProvider as SprykerPermissionDependencyProvider;
use Spryker\Client\QuoteApproval\Plugin\Permission\ApproveQuotePermissionPlugin;
use Spryker\Client\QuoteApproval\Plugin\Permission\PlaceOrderPermissionPlugin;
use Spryker\Client\QuoteApproval\Plugin\Permission\RequestQuoteApprovalPermissionPlugin;
use Spryker\Client\SharedCart\Plugin\ReadSharedCartPermissionPlugin;
use Spryker\Client\SharedCart\Plugin\WriteSharedCartPermissionPlugin;
use Spryker\Client\ShoppingList\Plugin\ReadShoppingListPermissionPlugin;
use Spryker\Client\ShoppingList\Plugin\WriteShoppingListPermissionPlugin;
use Spryker\Shared\Checkout\Plugin\Permission\PlaceOrderWithAmountUpToPermissionPlugin;
use Spryker\Shared\CompanyUser\Plugin\AddCompanyUserPermissionPlugin;
use Spryker\Shared\CompanyUserInvitation\Plugin\ManageCompanyUserInvitationPermissionPlugin;
use SprykerShop\Shared\CartPage\Plugin\AddCartItemPermissionPlugin;
use SprykerShop\Shared\CartPage\Plugin\ChangeCartItemPermissionPlugin;
use SprykerShop\Shared\CartPage\Plugin\RemoveCartItemPermissionPlugin;

class PermissionDependencyProvider extends SprykerPermissionDependencyProvider
{
    /**
     * @return array<\Spryker\Client\PermissionExtension\Dependency\Plugin\PermissionStoragePluginInterface>
     */
    protected function getPermissionStoragePlugins(): array
    {
        return [
            new PermissionStoragePlugin(), #SharedCartFeature #ShoppingListFeature
            new CustomerAccessPermissionStoragePlugin(), #CustomerAccessFeature
            new OauthPermissionStoragePlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface>
     */
    protected function getPermissionPlugins(): array
    {
        return [
            new ReadSharedCartPermissionPlugin(), #SharedCartFeature
            new WriteSharedCartPermissionPlugin(), #SharedCartFeature
            new ReadShoppingListPermissionPlugin(), #ShoppingListFeature
            new WriteShoppingListPermissionPlugin(), #ShoppingListFeature
            new SeeCompanyMenuPermissionPlugin(),
            new AddCartItemPermissionPlugin(),
            new ChangeCartItemPermissionPlugin(),
            new RemoveCartItemPermissionPlugin(),
            new PlaceOrderWithAmountUpToPermissionPlugin(),
            new ManageCompanyUserInvitationPermissionPlugin(),
            new AddCompanyUserPermissionPlugin(),
            new CompanyUserStatusChangePermissionPlugin(),
            new SeePricePermissionPlugin(), #CustomerAccessFeature
            new SeeOrderPlaceSubmitPermissionPlugin(), #CustomerAccessFeature
            new SeeAddToCartPermissionPlugin(), #CustomerAccessFeature
            new SeeWishlistPermissionPlugin(), #CustomerAccessFeature
            new SeeShoppingListPermissionPlugin(), #CustomerAccessFeature
            new RequestQuoteApprovalPermissionPlugin(), #QuoteApprovalFeature
            new PlaceOrderPermissionPlugin(), #QuoteApprovalFeature
            new ApproveQuotePermissionPlugin(), #QuoteApprovalFeature
            new SeeCompanyOrdersPermissionPlugin(),
            new SeeBusinessUnitOrdersPermissionPlugin(),
            new SeeCompanyUsersPermissionPlugin(),
            new CreateMerchantRelationRequestPermissionPlugin(),
            new CreateCompanyRolesPermissionPlugin(),
            new DeleteCompanyRolesPermissionPlugin(),
            new EditCompanyRolesPermissionPlugin(),
            new SeeCompanyRolesPermissionPlugin(),
            new CompanyUserStatusChangePermissionPlugin(),
            new DeleteCompanyUsersPermissionPlugin(),
            new EditCompanyUsersPermissionPlugin(),
            new AddCompanyUserPermissionPlugin(),
            new ManageCompanyUserInvitationPermissionPlugin(),
        ];
    }
}
