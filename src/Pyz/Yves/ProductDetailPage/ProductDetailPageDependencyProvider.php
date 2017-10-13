<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ProductDetailPage;

use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\AvailabilityWidget\Plugin\ProductDetailPage\AvailabilityWidgetPlugin;
use SprykerShop\Yves\AvailabilityWidget\Plugin\StorageProductAvailabilityExpanderPlugin;
use SprykerShop\Yves\ProductCategoryWidget\Plugin\ProductDetailPage\ProductCategoryWidgetPlugin;
use SprykerShop\Yves\ProductCategoryWidget\Plugin\StorageProductCategoryExpanderPlugin;
use SprykerShop\Yves\CmsBlockWidget\Plugin\ProductDetailPage\ProductCmsBlockWidgetPlugin;
use SprykerShop\Yves\ProductDetailPage\ProductDetailPageDependencyProvider as SprykerShopProductDetailPageDependencyProvider;
use SprykerShop\Yves\ProductGroupWidget\Plugin\ProductDetailPage\ProductGroupWidgetPlugin;
use SprykerShop\Yves\ProductImageWidget\Plugin\ProductDetailPage\ProductImageWidgetPlugin;
use SprykerShop\Yves\ProductImageWidget\Plugin\StorageProductImageExpanderPlugin;
use SprykerShop\Yves\ProductLabelWidget\Plugin\ProductDetailPage\ProductAbstractLabelWidgetPlugin;
use SprykerShop\Yves\ProductOptionWidget\Plugin\ProductDetailPage\ProductOptionWidgetPlugin;
use SprykerShop\Yves\ProductRelationWidget\Plugin\ProductRelationWidgetPlugin;
use SprykerShop\Yves\ProductReviewWidget\Plugin\ProductDetailPage\ProductReviewWidgetPlugin;
use SprykerShop\Yves\WishlistWidget\Plugin\ProductDetailPage\WishlistWidgetPlugin;

class ProductDetailPageDependencyProvider extends SprykerShopProductDetailPageDependencyProvider
{

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \SprykerShop\Yves\ProductDetailPage\Dependency\Plugin\StorageProductExpanderPluginInterface[]
     */
    protected function getStorageProductExpanderPlugins(Container $container): array
    {
        return [
            new StorageProductCategoryExpanderPlugin(),
            new StorageProductImageExpanderPlugin(),
            new StorageProductAvailabilityExpanderPlugin(),
        ];
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface[]
     */
    protected function getProductDetailPageWidgetPlugins(Container $container): array
    {
        return [
            ProductCategoryWidgetPlugin::class,
            ProductImageWidgetPlugin::class,
            ProductOptionWidgetPlugin::class,
            AvailabilityWidgetPlugin::class,
            WishlistWidgetPlugin::class,
            ProductReviewWidgetPlugin::class,
            ProductCmsBlockWidgetPlugin::class,
            ProductAbstractLabelWidgetPlugin::class,
            ProductRelationWidgetPlugin::class,
            ProductGroupWidgetPlugin::class,
        ];
    }

}
