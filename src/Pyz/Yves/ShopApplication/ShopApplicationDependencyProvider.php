<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ShopApplication;

use Pyz\Yves\CompanyPage\Plugin\ShopApplication\CompanyUserRestrictionHandlerPlugin;
use Pyz\Yves\CompanyWidget\Plugin\ShopUi\MenuItemCompanyWidgetPlugin;
use SprykerShop\Yves\AgentWidget\Plugin\Widget\AgentWidgetPlugin;
use SprykerShop\Yves\BusinessOnBehalfWidget\Plugin\ShopUi\DisplayOnBehalfBusinessWidgetPlugin;
use SprykerShop\Yves\BusinessOnBehalfWidget\Widget\BusinessOnBehalfStatusWidget;
use SprykerShop\Yves\CartNoteWidget\Widget\CartItemNoteFormWidget;
use SprykerShop\Yves\CartNoteWidget\Widget\CartNoteFormWidget;
use SprykerShop\Yves\CompanyPage\Plugin\ShopApplication\CheckBusinessOnBehalfCompanyUserHandlerPlugin;
use SprykerShop\Yves\CurrencyWidget\Plugin\ShopUi\CurrencyWidgetPlugin;
use SprykerShop\Yves\CustomerPage\Plugin\CustomerPage\CustomerNavigationWidgetPlugin;
use SprykerShop\Yves\DiscountPromotionWidget\Widget\CartDiscountPromotionProductListWidget;
use SprykerShop\Yves\DiscountWidget\Widget\DiscountVoucherFormWidget;
use SprykerShop\Yves\LanguageSwitcherWidget\Plugin\ShopUi\LanguageSwitcherWidgetPlugin;
use SprykerShop\Yves\MultiCartWidget\Plugin\ShopUi\MiniCartWidgetPlugin;
use SprykerShop\Yves\MultiCartWidget\Widget\MultiCartMenuItemWidget;
use SprykerShop\Yves\NavigationWidget\Plugin\ShopUi\NavigationWidgetPlugin;
use SprykerShop\Yves\NewsletterWidget\Widget\NewsletterSubscriptionSummaryWidget;
use SprykerShop\Yves\PriceWidget\Plugin\ShopUi\PriceModeSwitcherWidgetPlugin;
use SprykerShop\Yves\ProductGroupWidget\Plugin\ShopUi\ProductGroupWidgetPlugin;
use SprykerShop\Yves\ProductRelationWidget\Widget\UpSellingProductsWidget;
use SprykerShop\Yves\ShopApplication\ShopApplicationDependencyProvider as SprykerShopApplicationDependencyProvider;
use SprykerShop\Yves\ShoppingListWidget\Plugin\ShopUi\ShoppingListWidgetPlugin;
use SprykerShop\Yves\ShoppingListWidget\Widget\ShoppingListMenuItemWidget;

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
            ProductGroupWidgetPlugin::class,
            PriceModeSwitcherWidgetPlugin::class,
            MiniCartWidgetPlugin::class, #MultiCartFeature
            CustomerNavigationWidgetPlugin::class,
            DisplayOnBehalfBusinessWidgetPlugin::class,
            BusinessOnBehalfStatusWidget::class,
            MenuItemCompanyWidgetPlugin::class,
            ShoppingListWidgetPlugin::class, #ShoppingListFeature
            AgentWidgetPlugin::class, #AgentFeature
            DiscountVoucherFormWidget::class,
            CartDiscountPromotionProductListWidget::class,
            UpSellingProductsWidget::class,
            CartNoteFormWidget::class, #CartNoteFeature
            CartItemNoteFormWidget::class, #CartNoteFeature
            MultiCartMenuItemWidget::class,
            ShoppingListMenuItemWidget::class,
            NewsletterSubscriptionSummaryWidget::class,
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
