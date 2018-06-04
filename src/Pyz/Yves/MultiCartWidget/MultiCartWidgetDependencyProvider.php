<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\MultiCartWidget;

use SprykerShop\Yves\MultiCartWidget\MultiCartWidgetDependencyProvider as SprykerMultiCartWidgetDependencyProvider;
use SprykerShop\Yves\ProductBundleWidget\Plugin\MultiCartWidget\ProductBundleCartItemsWidgetPlugin;
use SprykerShop\Yves\ProductBundleWidget\Plugin\MultiCartWidget\ProductBundleItemCounterWidgetPlugin;
use SprykerShop\Yves\ProductBundleWidget\Plugin\MultiCartWidget\ProductBundleItemsWidgetPlugin;
use SprykerShop\Yves\SharedCartWidget\Plugin\MultiCartWidget\SharedCartAddSeparateProductWidgetPlugin;
use SprykerShop\Yves\SharedCartWidget\Plugin\MultiCartWidget\SharedCartDetailsWidgetPlugin;
use SprykerShop\Yves\SharedCartWidget\Plugin\MultiCartWidget\SharedCartOperationsWidgetPlugin;
use SprykerShop\Yves\SharedCartWidget\Plugin\MultiCartWidget\SharedCartShareWidgetPlugin;

class MultiCartWidgetDependencyProvider extends SprykerMultiCartWidgetDependencyProvider
{
    /**
     * @return array
     */
    protected function getViewExtendWidgetPlugins(): array
    {
        return [
            ProductBundleItemCounterWidgetPlugin::class, #ProductBundleFeature
            ProductBundleItemsWidgetPlugin::class, #ProductBundleFeature
            ProductBundleCartItemsWidgetPlugin::class, #ProductBundleFeature
            SharedCartDetailsWidgetPlugin::class, #SharedCartFeature
            SharedCartOperationsWidgetPlugin::class, #SharedCartFeature
            SharedCartShareWidgetPlugin::class, #SharedCartFeature
            SharedCartAddSeparateProductWidgetPlugin::class, #SharedCartFeature
        ];
    }
}
