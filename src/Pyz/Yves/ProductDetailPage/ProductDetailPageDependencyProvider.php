<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ProductDetailPage;

use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\AvailabilityWidget\Plugin\StorageProductAvailabilityExpanderPlugin;
use SprykerShop\Yves\ProductCategoryWidget\Plugin\ProductCategoryWidgetControllerResponseExtenderPlugin;
use SprykerShop\Yves\ProductCategoryWidget\Plugin\StorageProductCategoryExpanderPlugin;
use SprykerShop\Yves\ProductDetailPage\ProductDetailPageDependencyProvider as SprykerShopProductDetailPageDependencyProvider;
use SprykerShop\Yves\ProductImageWidget\Plugin\StorageProductImageExpanderPlugin;
use SprykerShop\Yves\ProductOptionWidget\Plugin\ProductOptionWidgetControllerResponseExtenderPlugin;

class ProductDetailPageDependencyProvider extends SprykerShopProductDetailPageDependencyProvider
{

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Dependency\Plugin\ControllerResponseExpanderPluginInterface[]
     */
    protected function getControllerResponseExpanderPlugins(Container $container)
    {
        return [
            new ProductOptionWidgetControllerResponseExtenderPlugin(),
            new ProductCategoryWidgetControllerResponseExtenderPlugin(),
        ];
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \SprykerShop\Yves\ProductDetailPage\Dependency\Plugin\StorageProductExpanderPluginInterface[]
     */
    protected function getStorageProductExpanderPlugins(Container $container)
    {
        return [
            new StorageProductCategoryExpanderPlugin(),
            new StorageProductImageExpanderPlugin(),
            new StorageProductAvailabilityExpanderPlugin(),
        ];
    }

}
