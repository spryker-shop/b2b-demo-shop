<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ShopApplication;

use SprykerShop\Yves\CompanyPage\Plugin\CompanyPageFilterControllerEventHandlerPlugin;
use SprykerShop\Yves\BusinessOnBehalfWidget\Plugin\CustomerPage\MenuItemBusinessOnBehalfWidgetPlugin;
use SprykerShop\Yves\BusinessOnBehalfWidget\Plugin\ShopLayout\DisplayOnBehalfBusinessWidgetPlugin;
use SprykerShop\Yves\CurrencyWidget\Plugin\ShopLayout\CurrencyWidgetPlugin;
use SprykerShop\Yves\LanguageSwitcherWidget\Plugin\ShopUi\LanguageSwitcherWidgetPlugin;
use SprykerShop\Yves\MultiCartWidget\Plugin\ShopUi\MiniCartWidgetPlugin;
use SprykerShop\Yves\NavigationWidget\Plugin\ShopLayout\NavigationWidgetPlugin;
use SprykerShop\Yves\PriceWidget\Plugin\ShopLayout\PriceModeSwitcherWidgetPlugin;
use SprykerShop\Yves\ProductGroupWidget\Plugin\ShopLayout\ProductGroupWidgetPlugin;
use SprykerShop\Yves\ShopApplication\ShopApplicationDependencyProvider as SprykerShopApplicationDependencyProvider;

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
            DisplayOnBehalfBusinessWidgetPlugin::class,
            MenuItemBusinessOnBehalfWidgetPlugin::class,
        ];
    }

    /**
     * @return \SprykerShop\Yves\ShopApplication\Dependency\Plugin\FilterControllerEventHandlerPluginInterface[]
     */
    protected function getFilterControllerEventSubscriberPlugins(): array
    {
        return [
            new CompanyPageFilterControllerEventHandlerPlugin(),
        ];
    }
}
