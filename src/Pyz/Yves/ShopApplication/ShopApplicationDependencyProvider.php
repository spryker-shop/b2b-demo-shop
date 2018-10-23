<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ShopApplication;

use Pyz\Yves\CompanyPage\Plugin\ShopApplication\CompanyUserRestrictionHandlerPlugin;
use Pyz\Yves\CompanyWidget\Plugin\ShopUi\MenuItemCompanyWidgetPlugin;
use SprykerShop\Yves\AgentWidget\Plugin\Widget\AgentWidgetPlugin;
use SprykerShop\Yves\AgentWidget\Widget\AgentControlBarWidget;
use SprykerShop\Yves\BusinessOnBehalfWidget\Plugin\ShopUi\DisplayOnBehalfBusinessWidgetPlugin;
use SprykerShop\Yves\BusinessOnBehalfWidget\Widget\BusinessOnBehalfStatusWidget;
use SprykerShop\Yves\CartNoteWidget\Widget\CartItemNoteFormWidget;
use SprykerShop\Yves\CartNoteWidget\Widget\CartNoteFormWidget;
use SprykerShop\Yves\CartToShoppingListWidget\Widget\CreateShoppingListFromCartWidget;
use SprykerShop\Yves\CompanyPage\Plugin\ShopApplication\CheckBusinessOnBehalfCompanyUserHandlerPlugin;
use SprykerShop\Yves\CurrencyWidget\Plugin\ShopUi\CurrencyWidgetPlugin;
use SprykerShop\Yves\CurrencyWidget\Widget\CurrencyWidget;
use SprykerShop\Yves\CustomerPage\Widget\CustomerNavigationWidget;
use SprykerShop\Yves\DiscountPromotionWidget\Widget\CartDiscountPromotionProductListWidget;
use SprykerShop\Yves\DiscountWidget\Widget\CheckoutVoucherFormWidget;
use SprykerShop\Yves\DiscountWidget\Widget\DiscountVoucherFormWidget;
use SprykerShop\Yves\LanguageSwitcherWidget\Plugin\ShopUi\LanguageSwitcherWidgetPlugin;
use SprykerShop\Yves\LanguageSwitcherWidget\Widget\LanguageSwitcherWidget;
use SprykerShop\Yves\MultiCartWidget\Plugin\ShopUi\MiniCartWidgetPlugin;
use SprykerShop\Yves\MultiCartWidget\Widget\MiniCartWidget;
use SprykerShop\Yves\MultiCartWidget\Widget\MultiCartMenuItemWidget;
use SprykerShop\Yves\NavigationWidget\Plugin\ShopUi\NavigationWidgetPlugin;
use SprykerShop\Yves\NavigationWidget\Widget\NavigationWidget;
use SprykerShop\Yves\NewsletterWidget\Widget\NewsletterSubscriptionSummaryWidget;
use SprykerShop\Yves\PriceWidget\Plugin\ShopUi\PriceModeSwitcherWidgetPlugin;
use SprykerShop\Yves\PriceWidget\Widget\PriceModeSwitcherWidget;
use SprykerShop\Yves\ProductAlternativeWidget\Widget\ShoppingListProductAlternativeWidget;
use SprykerShop\Yves\ProductBundleWidget\Widget\ProductBundleCartItemsListWidget;
use SprykerShop\Yves\ProductDiscontinuedWidget\Widget\ProductDiscontinuedWidget;
use SprykerShop\Yves\ProductGroupWidget\Widget\ProductGroupWidget;
use SprykerShop\Yves\ProductLabelWidget\Widget\ProductAbstractLabelWidget;
use SprykerShop\Yves\ProductMeasurementUnitWidget\Widget\CartProductMeasurementUnitQuantitySelectorWidget;
use SprykerShop\Yves\ProductRelationWidget\Widget\UpSellingProductsWidget;
use SprykerShop\Yves\ProductReviewWidget\Widget\DisplayProductAbstractReviewWidget;
use SprykerShop\Yves\ProductWidget\Widget\CatalogPageProductWidget;
use SprykerShop\Yves\ProductWidget\Widget\CmsProductWidget;
use SprykerShop\Yves\SalesOrderThresholdWidget\Widget\SalesOrderThresholdWidget;
use SprykerShop\Yves\ShopApplication\ShopApplicationDependencyProvider as SprykerShopApplicationDependencyProvider;
use SprykerShop\Yves\ShoppingListNoteWidget\Widget\ShoppingListItemNoteWidget;
use SprykerShop\Yves\ShoppingListWidget\Plugin\ShopUi\ShoppingListWidgetPlugin;
use SprykerShop\Yves\ShoppingListWidget\Widget\ShoppingListMenuItemWidget;
use SprykerShop\Yves\ShoppingListWidget\Widget\ShoppingListNavigationMenuWidget;

class ShopApplicationDependencyProvider extends SprykerShopApplicationDependencyProvider
{
    /**
     * @return string[]
     */
    protected function getGlobalWidgetPlugins(): array
    {
        return [
            CurrencyWidgetPlugin::class,
            LanguageSwitcherWidgetPlugin::class,
            NavigationWidgetPlugin::class,
            PriceModeSwitcherWidgetPlugin::class,
            MiniCartWidgetPlugin::class, #MultiCartFeature
            DisplayOnBehalfBusinessWidgetPlugin::class,
            MenuItemCompanyWidgetPlugin::class,
            ShoppingListWidgetPlugin::class, #ShoppingListFeature
            AgentWidgetPlugin::class, #AgentFeature
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
            ProductGroupWidget::class,
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
            ProductAbstractLabelWidget::class,
            DisplayProductAbstractReviewWidget::class,
            ProductGroupWidget::class,
            CartProductMeasurementUnitQuantitySelectorWidget::class,
            CustomerNavigationWidget::class,
            CartItemNoteFormWidget::class,
            ProductDiscontinuedWidget::class,
            ShoppingListProductAlternativeWidget::class,
            ProductBundleCartItemsListWidget::class,
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
        ];
    }
}
