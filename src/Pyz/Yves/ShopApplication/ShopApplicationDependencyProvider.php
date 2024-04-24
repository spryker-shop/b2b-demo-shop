<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ShopApplication;

use Pyz\Yves\CompanyPage\Plugin\ShopApplication\CompanyUserRestrictionHandlerPlugin;
use Pyz\Yves\CompanyWidget\Widget\MenuItemCompanyWidget;
use Pyz\Yves\CustomerFullNameWidget\Widget\CustomerFullNameWidget;
use Pyz\Yves\ProductSetWidget\Widget\ProductSetIdsWidget;
use Spryker\Yves\ErrorHandler\Plugin\Application\ErrorHandlerApplicationPlugin;
use Spryker\Yves\EventDispatcher\Plugin\Application\EventDispatcherApplicationPlugin;
use Spryker\Yves\Form\Plugin\Application\FormApplicationPlugin;
use Spryker\Yves\Http\Plugin\Application\YvesHttpApplicationPlugin;
use Spryker\Yves\Locale\Plugin\Application\LocaleApplicationPlugin;
use Spryker\Yves\Messenger\Plugin\Application\FlashMessengerApplicationPlugin;
use Spryker\Yves\Router\Plugin\Application\RouterApplicationPlugin;
use Spryker\Yves\Security\Plugin\Application\YvesSecurityApplicationPlugin;
use Spryker\Yves\Session\Plugin\Application\SessionApplicationPlugin;
use Spryker\Yves\Translator\Plugin\Application\TranslatorApplicationPlugin;
use Spryker\Yves\Twig\Plugin\Application\TwigApplicationPlugin;
use Spryker\Yves\Validator\Plugin\Application\ValidatorApplicationPlugin;
use SprykerShop\Yves\AgentWidget\Widget\AgentControlBarWidget;
use SprykerShop\Yves\AssetWidget\Widget\AssetWidget;
use SprykerShop\Yves\AvailabilityNotificationWidget\Widget\AvailabilityNotificationSubscriptionWidget;
use SprykerShop\Yves\BarcodeWidget\Widget\BarcodeWidget;
use SprykerShop\Yves\BusinessOnBehalfWidget\Widget\BusinessOnBehalfStatusWidget;
use SprykerShop\Yves\CartCodeWidget\Widget\CartCodeFormWidget;
use SprykerShop\Yves\CartNoteWidget\Plugin\ShopApplication\CartItemNoteFormWidgetCacheKeyGeneratorStrategyPlugin;
use SprykerShop\Yves\CartNoteWidget\Widget\CartItemNoteFormWidget;
use SprykerShop\Yves\CartNoteWidget\Widget\CartNoteFormWidget;
use SprykerShop\Yves\CartPage\Widget\AddItemsFormWidget;
use SprykerShop\Yves\CartPage\Widget\AddToCartFormWidget;
use SprykerShop\Yves\CartPage\Widget\CartAddProductAsSeparateItemWidget;
use SprykerShop\Yves\CartPage\Widget\CartChangeQuantityFormWidget;
use SprykerShop\Yves\CartPage\Widget\CartSummaryHideTaxAmountWidget;
use SprykerShop\Yves\CartPage\Widget\ProductAbstractAddToCartButtonWidget;
use SprykerShop\Yves\CartPage\Widget\RemoveFromCartFormWidget;
use SprykerShop\Yves\CategoryImageStorageWidget\Widget\CategoryImageStorageWidget;
use SprykerShop\Yves\CheckoutWidget\Widget\CheckoutBreadcrumbWidget;
use SprykerShop\Yves\CheckoutWidget\Widget\ProceedToCheckoutButtonWidget;
use SprykerShop\Yves\CommentWidget\Widget\CommentThreadWidget;
use SprykerShop\Yves\CompanyPage\Plugin\ShopApplication\CheckBusinessOnBehalfCompanyUserHandlerPlugin;
use SprykerShop\Yves\CompanyPage\Plugin\ShopApplication\CompanyBusinessUnitControllerRestrictionPlugin;
use SprykerShop\Yves\CompanyWidget\Widget\CompanyBusinessUnitAddressWidget;
use SprykerShop\Yves\CompanyWidget\Widget\CompanyMenuItemWidget;
use SprykerShop\Yves\ConfigurableBundleNoteWidget\Widget\ConfiguredBundleNoteWidget;
use SprykerShop\Yves\ConfigurableBundleWidget\Widget\QuoteConfiguredBundleWidget;
use SprykerShop\Yves\CurrencyWidget\Widget\CurrencyWidget;
use SprykerShop\Yves\CustomerPage\Plugin\Application\CustomerConfirmationUserCheckerApplicationPlugin;
use SprykerShop\Yves\CustomerPage\Widget\CustomerNavigationWidget;
use SprykerShop\Yves\CustomerReorderWidget\Plugin\CustomerPage\CustomerReorderFormWidget;
use SprykerShop\Yves\CustomerReorderWidget\Plugin\CustomerPage\CustomerReorderItemsFormWidget;
use SprykerShop\Yves\CustomerReorderWidget\Widget\CustomerReorderBundleItemCheckboxWidget;
use SprykerShop\Yves\CustomerReorderWidget\Widget\CustomerReorderItemCheckboxWidget;
use SprykerShop\Yves\CustomerValidationPage\Plugin\ShopApplication\LogoutInvalidatedCustomerFilterControllerEventHandlerPlugin;
use SprykerShop\Yves\DiscountPromotionWidget\Plugin\ShopApplication\CartDiscountPromotionProductListWidgetCacheKeyGeneratorStrategyPlugin;
use SprykerShop\Yves\DiscountPromotionWidget\Widget\CartDiscountPromotionProductListWidget;
use SprykerShop\Yves\LanguageSwitcherWidget\Widget\LanguageSwitcherWidget;
use SprykerShop\Yves\MerchantRelationRequestWidget\Widget\MerchantRelationRequestCreateButtonWidget;
use SprykerShop\Yves\MerchantRelationRequestWidget\Widget\MerchantRelationRequestCreateLinkWidget;
use SprykerShop\Yves\MerchantRelationRequestWidget\Widget\MerchantRelationRequestMenuItemWidget;
use SprykerShop\Yves\MerchantRelationshipWidget\Widget\MerchantRelationshipLinkListWidget;
use SprykerShop\Yves\MerchantRelationshipWidget\Widget\MerchantRelationshipMenuItemWidget;
use SprykerShop\Yves\MoneyWidget\Widget\CurrencyIsoCodeWidget;
use SprykerShop\Yves\MultiCartWidget\Widget\AddToMultiCartWidget;
use SprykerShop\Yves\MultiCartWidget\Widget\CartOperationsWidget;
use SprykerShop\Yves\MultiCartWidget\Widget\MiniCartWidget;
use SprykerShop\Yves\MultiCartWidget\Widget\MultiCartListWidget;
use SprykerShop\Yves\MultiCartWidget\Widget\MultiCartMenuItemWidget;
use SprykerShop\Yves\MultiCartWidget\Widget\QuickOrderPageWidget;
use SprykerShop\Yves\NewsletterWidget\Widget\NewsletterSubscriptionSummaryWidget;
use SprykerShop\Yves\NewsletterWidget\Widget\NewsletterSubscriptionWidget;
use SprykerShop\Yves\OrderCancelWidget\Widget\OrderCancelButtonWidget;
use SprykerShop\Yves\OrderCustomReferenceWidget\Widget\OrderCustomReferenceWidget;
use SprykerShop\Yves\PersistentCartShareWidget\Widget\ShareCartByLinkWidget;
use SprykerShop\Yves\PriceProductVolumeWidget\Widget\CurrentProductPriceVolumeWidget;
use SprykerShop\Yves\PriceProductWidget\Widget\PriceProductWidget;
use SprykerShop\Yves\PriceWidget\Widget\PriceModeSwitcherWidget;
use SprykerShop\Yves\ProductAlternativeWidget\Widget\ProductAlternativeListWidget;
use SprykerShop\Yves\ProductAlternativeWidget\Widget\ShoppingListProductAlternativeWidget;
use SprykerShop\Yves\ProductAlternativeWidget\Widget\WishlistProductAlternativeWidget;
use SprykerShop\Yves\ProductBarcodeWidget\Widget\ProductBarcodeWidget;
use SprykerShop\Yves\ProductBundleWidget\Widget\ProductBundleCartItemsListWidget;
use SprykerShop\Yves\ProductBundleWidget\Widget\ProductBundleItemCounterWidget;
use SprykerShop\Yves\ProductBundleWidget\Widget\ProductBundleItemsMultiCartItemsListWidget;
use SprykerShop\Yves\ProductBundleWidget\Widget\ProductBundleMultiCartItemsListWidget;
use SprykerShop\Yves\ProductBundleWidget\Widget\ProductBundleProductDetailPageItemsListWidget;
use SprykerShop\Yves\ProductCategoryWidget\Widget\ProductBreadcrumbsWithCategoriesWidget;
use SprykerShop\Yves\ProductCategoryWidget\Widget\ProductSchemaOrgCategoryWidget;
use SprykerShop\Yves\ProductConfigurationCartWidget\Widget\ProductConfigurationCartItemDisplayWidget;
use SprykerShop\Yves\ProductConfigurationCartWidget\Widget\ProductConfigurationCartPageButtonWidget;
use SprykerShop\Yves\ProductConfigurationCartWidget\Widget\ProductConfigurationQuoteValidatorWidget;
use SprykerShop\Yves\ProductConfigurationShoppingListWidget\Widget\ProductConfigurationShoppingListItemDisplayWidget;
use SprykerShop\Yves\ProductConfigurationShoppingListWidget\Widget\ProductConfigurationShoppingListPageButtonWidget;
use SprykerShop\Yves\ProductConfigurationWidget\Widget\ProductConfigurationProductDetailPageButtonWidget;
use SprykerShop\Yves\ProductConfigurationWidget\Widget\ProductConfigurationProductViewDisplayWidget;
use SprykerShop\Yves\ProductDiscontinuedWidget\Widget\ProductDiscontinuedNoteWidget;
use SprykerShop\Yves\ProductDiscontinuedWidget\Widget\ProductDiscontinuedWidget;
use SprykerShop\Yves\ProductGroupWidget\Widget\ProductGroupColorWidget;
use SprykerShop\Yves\ProductGroupWidget\Widget\ProductGroupWidget;
use SprykerShop\Yves\ProductLabelWidget\Widget\ProductAbstractLabelWidget;
use SprykerShop\Yves\ProductLabelWidget\Widget\ProductConcreteLabelWidget;
use SprykerShop\Yves\ProductMeasurementUnitWidget\Widget\CartProductMeasurementUnitQuantitySelectorWidget;
use SprykerShop\Yves\ProductMeasurementUnitWidget\Widget\ManageProductMeasurementUnitWidget;
use SprykerShop\Yves\ProductOptionWidget\Widget\ProductOptionConfiguratorWidget;
use SprykerShop\Yves\ProductPackagingUnitWidget\Widget\ProductPackagingUnitWidget;
use SprykerShop\Yves\ProductRelationWidget\Widget\SimilarProductsWidget;
use SprykerShop\Yves\ProductRelationWidget\Widget\UpSellingProductsWidget;
use SprykerShop\Yves\ProductReplacementForWidget\Widget\ProductReplacementForListWidget;
use SprykerShop\Yves\ProductReviewWidget\Widget\DisplayProductAbstractReviewWidget;
use SprykerShop\Yves\ProductReviewWidget\Widget\ProductDetailPageReviewWidget;
use SprykerShop\Yves\ProductReviewWidget\Widget\ProductRatingFilterWidget;
use SprykerShop\Yves\ProductReviewWidget\Widget\ProductReviewDisplayWidget;
use SprykerShop\Yves\ProductSearchWidget\Widget\ProductConcreteAddWidget;
use SprykerShop\Yves\ProductSearchWidget\Widget\ProductConcreteSearchGridWidget;
use SprykerShop\Yves\ProductSearchWidget\Widget\ProductConcreteSearchWidget;
use SprykerShop\Yves\ProductWidget\Widget\CatalogPageProductWidget;
use SprykerShop\Yves\ProductWidget\Widget\CmsProductGroupWidget;
use SprykerShop\Yves\ProductWidget\Widget\CmsProductWidget;
use SprykerShop\Yves\ProductWidget\Widget\PdpProductRelationWidget;
use SprykerShop\Yves\ProductWidget\Widget\PdpProductReplacementForListWidget;
use SprykerShop\Yves\ProductWidget\Widget\ProductAlternativeWidget;
use SprykerShop\Yves\QuoteApprovalWidget\Plugin\ShopApplication\QuoteApprovalStatusWidgetCacheKeyGeneratorStrategyPlugin;
use SprykerShop\Yves\QuoteApprovalWidget\Plugin\ShopApplication\QuoteApprovalWidgetCacheKeyGeneratorStrategyPlugin;
use SprykerShop\Yves\QuoteApprovalWidget\Plugin\ShopApplication\QuoteApproveRequestWidgetCacheKeyGeneratorStrategyPlugin;
use SprykerShop\Yves\QuoteApprovalWidget\Widget\QuoteApprovalStatusWidget;
use SprykerShop\Yves\QuoteApprovalWidget\Widget\QuoteApprovalWidget;
use SprykerShop\Yves\QuoteApprovalWidget\Widget\QuoteApproveRequestWidget;
use SprykerShop\Yves\QuoteRequestAgentWidget\Widget\QuoteRequestAgentCancelWidget;
use SprykerShop\Yves\QuoteRequestAgentWidget\Widget\QuoteRequestAgentOverviewWidget;
use SprykerShop\Yves\QuoteRequestWidget\Widget\QuoteRequestActionsWidget;
use SprykerShop\Yves\QuoteRequestWidget\Widget\QuoteRequestCancelWidget;
use SprykerShop\Yves\QuoteRequestWidget\Widget\QuoteRequestCartWidget;
use SprykerShop\Yves\QuoteRequestWidget\Widget\QuoteRequestCreateWidget;
use SprykerShop\Yves\QuoteRequestWidget\Widget\QuoteRequestMenuItemWidget;
use SprykerShop\Yves\SalesConfigurableBundleWidget\Widget\OrderItemsConfiguredBundleWidget;
use SprykerShop\Yves\SalesOrderThresholdWidget\Widget\SalesOrderThresholdWidget;
use SprykerShop\Yves\SalesProductBundleWidget\Widget\OrderItemsProductBundleWidget;
use SprykerShop\Yves\SalesProductConfigurationWidget\Widget\ProductConfigurationOrderItemDisplayWidget;
use SprykerShop\Yves\SharedCartWidget\Widget\CartDeleteSharingCompanyUsersListWidget;
use SprykerShop\Yves\SharedCartWidget\Widget\CartListPermissionGroupWidget;
use SprykerShop\Yves\SharedCartWidget\Widget\SharedCartDetailsWidget;
use SprykerShop\Yves\SharedCartWidget\Widget\SharedCartOperationsWidget;
use SprykerShop\Yves\SharedCartWidget\Widget\SharedCartPermissionGroupWidget;
use SprykerShop\Yves\SharedCartWidget\Widget\SharedCartShareWidget;
use SprykerShop\Yves\ShopApplication\Plugin\Application\ShopApplicationApplicationPlugin;
use SprykerShop\Yves\ShopApplication\ShopApplicationDependencyProvider as SprykerShopApplicationDependencyProvider;
use SprykerShop\Yves\ShoppingListNoteWidget\Widget\ShoppingListItemNoteWidget;
use SprykerShop\Yves\ShoppingListPage\Widget\ShoppingListDismissWidget;
use SprykerShop\Yves\ShoppingListWidget\Widget\AddItemsToShoppingListWidget;
use SprykerShop\Yves\ShoppingListWidget\Widget\AddToShoppingListWidget;
use SprykerShop\Yves\ShoppingListWidget\Widget\CreateShoppingListFromCartWidget;
use SprykerShop\Yves\ShoppingListWidget\Widget\ShoppingListMenuItemWidget;
use SprykerShop\Yves\ShoppingListWidget\Widget\ShoppingListNavigationMenuWidget;
use SprykerShop\Yves\ShoppingListWidget\Widget\ShoppingListSubtotalWidget;
use SprykerShop\Yves\StoreWidget\Plugin\ShopApplication\StoreApplicationPlugin;
use SprykerShop\Yves\StoreWidget\Widget\StoreSwitcherWidget;
use SprykerShop\Yves\TabsWidget\Widget\FullTextSearchTabsWidget;
use SprykerShop\Yves\WebProfilerWidget\Plugin\Application\WebProfilerApplicationPlugin;

/**
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 */
class ShopApplicationDependencyProvider extends SprykerShopApplicationDependencyProvider
{
    /**
     * @return array<string>
     */
    protected function getGlobalWidgets(): array
    {
        return [
            AddToMultiCartWidget::class,
            AddToShoppingListWidget::class,
            AgentControlBarWidget::class,
            BusinessOnBehalfStatusWidget::class,
            CartDeleteSharingCompanyUsersListWidget::class,
            CartDiscountPromotionProductListWidget::class,
            CartCodeFormWidget::class,
            CartItemNoteFormWidget::class,
            CartListPermissionGroupWidget::class,
            CartNoteFormWidget::class,
            CartOperationsWidget::class,
            CartProductMeasurementUnitQuantitySelectorWidget::class,
            CatalogPageProductWidget::class,
            CheckoutBreadcrumbWidget::class,
            CmsProductGroupWidget::class,
            CmsProductWidget::class,
            CompanyMenuItemWidget::class,
            CreateShoppingListFromCartWidget::class,
            CurrencyWidget::class,
            CurrencyIsoCodeWidget::class,
            CustomerNavigationWidget::class,
            DisplayProductAbstractReviewWidget::class,
            ProductGroupColorWidget::class,
            LanguageSwitcherWidget::class,
            ManageProductMeasurementUnitWidget::class,
            MiniCartWidget::class,
            MultiCartListWidget::class,
            MultiCartMenuItemWidget::class,
            QuoteRequestMenuItemWidget::class,
            NewsletterSubscriptionWidget::class,
            NewsletterSubscriptionSummaryWidget::class,
            PdpProductRelationWidget::class,
            PdpProductReplacementForListWidget::class,
            ProductReplacementForListWidget::class,
            PriceModeSwitcherWidget::class,
            ProductAbstractLabelWidget::class,
            ProductAlternativeListWidget::class,
            ProductAlternativeWidget::class,
            ProductBarcodeWidget::class,
            ProductBreadcrumbsWithCategoriesWidget::class,
            ProductBundleCartItemsListWidget::class,
            ProductBundleItemCounterWidget::class,
            ProductBundleItemsMultiCartItemsListWidget::class,
            ProductBundleMultiCartItemsListWidget::class,
            ProductConcreteLabelWidget::class,
            ProductDetailPageReviewWidget::class,
            ProductDiscontinuedNoteWidget::class,
            ProductDiscontinuedWidget::class,
            ProductGroupWidget::class,
            ProductOptionConfiguratorWidget::class,
            ProductPackagingUnitWidget::class,
            CurrentProductPriceVolumeWidget::class,
            ProductRatingFilterWidget::class,
            ProductReviewDisplayWidget::class,
            QuickOrderPageWidget::class,
            SalesOrderThresholdWidget::class,
            ShareCartByLinkWidget::class,
            SharedCartDetailsWidget::class,
            SharedCartOperationsWidget::class,
            SharedCartPermissionGroupWidget::class,
            SharedCartShareWidget::class,
            ShoppingListDismissWidget::class,
            ShoppingListItemNoteWidget::class,
            ShoppingListMenuItemWidget::class,
            ShoppingListNavigationMenuWidget::class,
            ShoppingListProductAlternativeWidget::class,
            ShoppingListSubtotalWidget::class,
            SimilarProductsWidget::class,
            UpSellingProductsWidget::class,
            WishlistProductAlternativeWidget::class,
            CompanyBusinessUnitAddressWidget::class,
            FullTextSearchTabsWidget::class,
            QuoteApprovalStatusWidget::class,
            QuoteApproveRequestWidget::class,
            ProceedToCheckoutButtonWidget::class,
            QuoteApprovalWidget::class,
            ProductConcreteSearchWidget::class,
            ProductConcreteSearchGridWidget::class,
            PriceProductWidget::class,
            AddItemsToShoppingListWidget::class,
            CategoryImageStorageWidget::class,
            AvailabilityNotificationSubscriptionWidget::class,
            ProductConcreteAddWidget::class,
            QuoteRequestCreateWidget::class,
            QuoteRequestCartWidget::class,
            QuoteRequestCancelWidget::class,
            QuoteRequestAgentOverviewWidget::class,
            QuoteRequestAgentCancelWidget::class,
            CommentThreadWidget::class,
            QuoteConfiguredBundleWidget::class,
            ConfiguredBundleNoteWidget::class,
            QuoteRequestActionsWidget::class,
            OrderCustomReferenceWidget::class,
            OrderItemsConfiguredBundleWidget::class,
            BarcodeWidget::class,
            AddToCartFormWidget::class,
            AddItemsFormWidget::class,
            CartChangeQuantityFormWidget::class,
            CustomerReorderFormWidget::class,
            CustomerReorderItemsFormWidget::class,
            OrderItemsProductBundleWidget::class,
            RemoveFromCartFormWidget::class,
            ProductAbstractAddToCartButtonWidget::class,
            OrderCancelButtonWidget::class,
            MenuItemCompanyWidget::class,
            CustomerFullNameWidget::class,
            ProductSetIdsWidget::class,
            CartAddProductAsSeparateItemWidget::class,
            ProductSchemaOrgCategoryWidget::class,
            AssetWidget::class,
            CustomerReorderItemCheckboxWidget::class,
            CustomerReorderBundleItemCheckboxWidget::class,
            ProductBundleProductDetailPageItemsListWidget::class,
            ProductConfigurationCartPageButtonWidget::class,
            ProductConfigurationCartItemDisplayWidget::class,
            ProductConfigurationProductDetailPageButtonWidget::class,
            ProductConfigurationProductViewDisplayWidget::class,
            ProductConfigurationOrderItemDisplayWidget::class,
            ProductConfigurationQuoteValidatorWidget::class,
            ProductConfigurationShoppingListItemDisplayWidget::class,
            ProductConfigurationShoppingListPageButtonWidget::class,
            StoreSwitcherWidget::class,
            CartSummaryHideTaxAmountWidget::class,
            MerchantRelationRequestCreateLinkWidget::class,
            MerchantRelationRequestCreateButtonWidget::class,
            MerchantRelationRequestMenuItemWidget::class,
            MerchantRelationshipMenuItemWidget::class,
            MerchantRelationshipLinkListWidget::class,
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\ShopApplicationExtension\Dependency\Plugin\WidgetCacheKeyGeneratorStrategyPluginInterface>
     */
    protected function getWidgetCacheKeyGeneratorStrategyPlugins(): array
    {
        return [
            new QuoteApprovalStatusWidgetCacheKeyGeneratorStrategyPlugin(),
            new QuoteApproveRequestWidgetCacheKeyGeneratorStrategyPlugin(),
            new QuoteApprovalWidgetCacheKeyGeneratorStrategyPlugin(),
            new CartDiscountPromotionProductListWidgetCacheKeyGeneratorStrategyPlugin(),
            new CartItemNoteFormWidgetCacheKeyGeneratorStrategyPlugin(),
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\ShopApplicationExtension\Dependency\Plugin\FilterControllerEventHandlerPluginInterface>
     */
    protected function getFilterControllerEventSubscriberPlugins(): array
    {
        return [
            new CompanyUserRestrictionHandlerPlugin(),
            new CheckBusinessOnBehalfCompanyUserHandlerPlugin(), #BusinessOnBehalfFeature
            new CompanyBusinessUnitControllerRestrictionPlugin(),
            new LogoutInvalidatedCustomerFilterControllerEventHandlerPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Shared\ApplicationExtension\Dependency\Plugin\ApplicationPluginInterface>
     */
    protected function getApplicationPlugins(): array
    {
        $applicationPlugins = [
            new YvesHttpApplicationPlugin(),
            new TwigApplicationPlugin(),
            new EventDispatcherApplicationPlugin(),
            new ShopApplicationApplicationPlugin(),
            new StoreApplicationPlugin(),
            new LocaleApplicationPlugin(),
            new TranslatorApplicationPlugin(),
            new RouterApplicationPlugin(),
            new SessionApplicationPlugin(),
            new ErrorHandlerApplicationPlugin(),
            new FlashMessengerApplicationPlugin(),
            new FormApplicationPlugin(),
            new ValidatorApplicationPlugin(),
            new YvesSecurityApplicationPlugin(),
            new CustomerConfirmationUserCheckerApplicationPlugin(),
        ];

        if (class_exists(WebProfilerApplicationPlugin::class)) {
            $applicationPlugins[] = new WebProfilerApplicationPlugin();
        }

        return $applicationPlugins;
    }
}
