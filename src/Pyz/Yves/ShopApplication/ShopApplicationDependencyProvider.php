<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ShopApplication;

use Pyz\Yves\BusinessOnBehalfWidget\Widget\BusinessOnBehalfStatusWidget;
use Pyz\Yves\CompanyPage\Plugin\ShopApplication\CompanyUserRestrictionHandlerPlugin;
use Pyz\Yves\CompanyWidget\Widget\MenuItemCompanyWidget;
use Pyz\Yves\CustomerFullNameWidget\Widget\CustomerFullNameWidget;
use Pyz\Yves\ExampleProductColorGroupWidget\Widget\ExampleProductColorSelectorWidget;
use Pyz\Yves\ProductSetWidget\Widget\ProductSetIdsWidget;
use SprykerShop\Yves\AgentWidget\Widget\AgentControlBarWidget;
use SprykerShop\Yves\CartNoteWidget\Widget\CartItemNoteFormWidget;
use SprykerShop\Yves\CartNoteWidget\Widget\CartNoteFormWidget;
use SprykerShop\Yves\CartToShoppingListWidget\Widget\CreateShoppingListFromCartWidget;
use SprykerShop\Yves\CompanyPage\Plugin\ShopApplication\CheckBusinessOnBehalfCompanyUserHandlerPlugin;
use SprykerShop\Yves\CompanyPage\Plugin\ShopApplication\CompanyBusinessUnitControllerRestrictionPlugin;
use SprykerShop\Yves\CompanyWidget\Widget\CompanyBusinessUnitAddressWidget;
use SprykerShop\Yves\CurrencyWidget\Widget\CurrencyWidget;
use SprykerShop\Yves\CustomerPage\Widget\CustomerNavigationWidget;
use SprykerShop\Yves\DiscountPromotionWidget\Widget\CartDiscountPromotionProductListWidget;
use SprykerShop\Yves\DiscountWidget\Widget\CheckoutVoucherFormWidget;
use SprykerShop\Yves\DiscountWidget\Widget\DiscountVoucherFormWidget;
use SprykerShop\Yves\LanguageSwitcherWidget\Widget\LanguageSwitcherWidget;
use SprykerShop\Yves\MultiCartWidget\Widget\AddToMultiCartWidget;
use SprykerShop\Yves\MultiCartWidget\Widget\MiniCartWidget;
use SprykerShop\Yves\MultiCartWidget\Widget\MultiCartMenuItemWidget;
use SprykerShop\Yves\MultiCartWidget\Widget\QuickOrderPageWidget;
use SprykerShop\Yves\NavigationWidget\Widget\NavigationWidget;
use SprykerShop\Yves\NewsletterWidget\Widget\NewsletterSubscriptionSummaryWidget;
use SprykerShop\Yves\PriceProductVolumeWidget\Widget\ProductPriceVolumeWidget;
use SprykerShop\Yves\PriceWidget\Widget\PriceModeSwitcherWidget;
use SprykerShop\Yves\ProductAlternativeWidget\Widget\ProductAlternativeListWidget;
use SprykerShop\Yves\ProductAlternativeWidget\Widget\ShoppingListProductAlternativeWidget;
use SprykerShop\Yves\ProductBundleWidget\Widget\ProductBundleCartItemsListWidget;
use SprykerShop\Yves\ProductBundleWidget\Widget\ProductBundleItemCounterWidget;
use SprykerShop\Yves\ProductCategoryWidget\Widget\ProductBreadcrumbsWithCategoriesWidget;
use SprykerShop\Yves\ProductDiscontinuedWidget\Widget\ProductDiscontinuedNoteWidget;
use SprykerShop\Yves\ProductDiscontinuedWidget\Widget\ProductDiscontinuedWidget;
use SprykerShop\Yves\ProductGroupWidget\Widget\ProductGroupWidget;
use SprykerShop\Yves\ProductLabelWidget\Widget\ProductAbstractLabelWidget;
use SprykerShop\Yves\ProductLabelWidget\Widget\ProductConcreteLabelWidget;
use SprykerShop\Yves\ProductMeasurementUnitWidget\Widget\CartProductMeasurementUnitQuantitySelectorWidget;
use SprykerShop\Yves\ProductMeasurementUnitWidget\Widget\ManageProductMeasurementUnitWidget;
use SprykerShop\Yves\ProductOptionWidget\Widget\ProductOptionConfiguratorWidget;
use SprykerShop\Yves\ProductPackagingUnitWidget\Widget\ProductPackagingUnitWidget;
use SprykerShop\Yves\ProductRelationWidget\Widget\SimilarProductsWidget;
use SprykerShop\Yves\ProductRelationWidget\Widget\UpSellingProductsWidget;
use SprykerShop\Yves\ProductReviewWidget\Widget\DisplayProductAbstractReviewWidget;
use SprykerShop\Yves\ProductReviewWidget\Widget\ProductDetailPageReviewWidget;
use SprykerShop\Yves\ProductReviewWidget\Widget\ProductRatingFilterWidget;
use SprykerShop\Yves\ProductReviewWidget\Widget\ProductReviewDisplayWidget;
use SprykerShop\Yves\ProductWidget\Widget\CatalogPageProductWidget;
use SprykerShop\Yves\ProductWidget\Widget\CmsProductWidget;
use SprykerShop\Yves\ProductWidget\Widget\PdpProductRelationWidget;
use SprykerShop\Yves\ProductWidget\Widget\PdpProductReplacementForListWidget;
use SprykerShop\Yves\ProductWidget\Widget\ProductAlternativeWidget;
use SprykerShop\Yves\SalesOrderThresholdWidget\Widget\SalesOrderThresholdWidget;
use SprykerShop\Yves\SharedCartWidget\Widget\CartDeleteCompanyUsersListWidget;
use SprykerShop\Yves\SharedCartWidget\Widget\CartListPermissionGroupWidget;
use SprykerShop\Yves\SharedCartWidget\Widget\SharedCartPermissionGroupWidget;
use SprykerShop\Yves\ShopApplication\ShopApplicationDependencyProvider as SprykerShopApplicationDependencyProvider;
use SprykerShop\Yves\ShoppingListNoteWidget\Widget\ShoppingListItemNoteWidget;
use SprykerShop\Yves\ShoppingListWidget\Widget\AddToShoppingListWidget;
use SprykerShop\Yves\ShoppingListWidget\Widget\ShoppingListMenuItemWidget;
use SprykerShop\Yves\ShoppingListWidget\Widget\ShoppingListNavigationMenuWidget;

class ShopApplicationDependencyProvider extends SprykerShopApplicationDependencyProvider
{
    /**
     * @return string[]
     */
    protected function getGlobalWidgets(): array
    {
        return [
            CartListPermissionGroupWidget::class,
            ProductBundleItemCounterWidget::class,
            CartDeleteCompanyUsersListWidget::class,
            SharedCartPermissionGroupWidget::class,
            ProductDiscontinuedNoteWidget::class,
            ProductDetailPageReviewWidget::class,
            ProductOptionConfiguratorWidget::class,
            ProductPackagingUnitWidget::class,
            ManageProductMeasurementUnitWidget::class,
            AddToMultiCartWidget::class,
            AddToShoppingListWidget::class,
            PdpProductRelationWidget::class,
            PdpProductReplacementForListWidget::class,
            ProductAlternativeWidget::class,
            ProductBreadcrumbsWithCategoriesWidget::class,
            SimilarProductsWidget::class,
            ProductAlternativeListWidget::class,
            ProductAbstractLabelWidget::class,
            ProductConcreteLabelWidget::class,
            ProductPriceVolumeWidget::class,
            ProductGroupWidget::class,
            QuickOrderPageWidget::class,
            ProductReviewDisplayWidget::class,
            MenuItemCompanyWidget::class,
            ProductSetIdsWidget::class,
            CmsProductWidget::class,
            SalesOrderThresholdWidget::class,
            CartDiscountPromotionProductListWidget::class,
            CartNoteFormWidget::class,
            CreateShoppingListFromCartWidget::class,
            DiscountVoucherFormWidget::class,
            UpSellingProductsWidget::class,
            CatalogPageProductWidget::class,
            CheckoutVoucherFormWidget::class,
            ShoppingListMenuItemWidget::class,
            MultiCartMenuItemWidget::class,
            BusinessOnBehalfStatusWidget::class,
            CustomerNavigationWidget::class,
            NewsletterSubscriptionSummaryWidget::class,
            ProductDiscontinuedWidget::class,
            ShoppingListItemNoteWidget::class,
            ShoppingListProductAlternativeWidget::class,
            AgentControlBarWidget::class,
            PriceModeSwitcherWidget::class,
            CurrencyWidget::class,
            LanguageSwitcherWidget::class,
            NavigationWidget::class,
            ShoppingListNavigationMenuWidget::class,
            MiniCartWidget::class,
            DisplayProductAbstractReviewWidget::class,
            CartProductMeasurementUnitQuantitySelectorWidget::class,
            CustomerNavigationWidget::class,
            CartItemNoteFormWidget::class,
            ProductBundleCartItemsListWidget::class,
            ExampleProductColorSelectorWidget::class,
            CompanyBusinessUnitAddressWidget::class,
            ProductRatingFilterWidget::class,
            CustomerFullNameWidget::class,
        ];
    }

    /**
     * @return \SprykerShop\Yves\ShopApplicationExtension\Dependency\Plugin\FilterControllerEventHandlerPluginInterface[]
     */
    protected function getFilterControllerEventSubscriberPlugins(): array
    {
        return [
            new CompanyUserRestrictionHandlerPlugin(),
            new CheckBusinessOnBehalfCompanyUserHandlerPlugin(), #BusinessOnBehalfFeature
            new CompanyBusinessUnitControllerRestrictionPlugin(),
        ];
    }
}
