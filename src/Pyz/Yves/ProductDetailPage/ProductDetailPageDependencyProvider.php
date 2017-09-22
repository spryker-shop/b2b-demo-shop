<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ProductDetailPage;

use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\AvailabilityWidget\Plugin\ProductDetailPage\AvailabilityWidgetBuilderPlugin;
use SprykerShop\Yves\AvailabilityWidget\Plugin\StorageProductAvailabilityExpanderPlugin;
use SprykerShop\Yves\ProductCategoryWidget\Plugin\ProductDetailPage\ProductCategoryWidgetBuilderPlugin;
use SprykerShop\Yves\ProductCategoryWidget\Plugin\StorageProductCategoryExpanderPlugin;
use SprykerShop\Yves\ProductCmsBlockWidget\Plugin\ProductDetailPage\ProductCmsBlockWidgetBuilderPlugin;
use SprykerShop\Yves\ProductDetailPage\ProductDetailPageDependencyProvider as SprykerShopProductDetailPageDependencyProvider;
use SprykerShop\Yves\ProductGroupWidget\Plugin\ProductDetailPage\ProductGroupWidgetBuilderPlugin;
use SprykerShop\Yves\ProductImageWidget\Plugin\ProductDetailPage\ProductImageWidgetBuilderPlugin;
use SprykerShop\Yves\ProductImageWidget\Plugin\StorageProductImageExpanderPlugin;
use SprykerShop\Yves\ProductLabelWidget\Plugin\ProductDetailPage\ProductLabelWidgetBuilderPlugin;
use SprykerShop\Yves\ProductOptionWidget\Plugin\ProductDetailPage\ProductOptionWidgetBuilderPlugin;
use SprykerShop\Yves\ProductRelationWidget\Plugin\ProductDetailPage\ProductRelationWidgetBuilderPlugin;
use SprykerShop\Yves\ProductReviewWidget\Plugin\ProductDetailPage\ProductReviewWidgetBuilderPlugin;
use SprykerShop\Yves\WishlistWidget\Plugin\ProductDetailPage\WishlistWidgetBuilderPlugin;

class ProductDetailPageDependencyProvider extends SprykerShopProductDetailPageDependencyProvider
{

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Dependency\Plugin\WidgetBuilderPluginInterface[]
     */
    protected function getProductDetailPageWidgetBuilderPlugins(Container $container)
    {
        return [
            new ProductOptionWidgetBuilderPlugin(),
            new ProductCategoryWidgetBuilderPlugin(),
            new ProductImageWidgetBuilderPlugin(),
            new AvailabilityWidgetBuilderPlugin(),
            new ProductLabelWidgetBuilderPlugin(),
            new ProductGroupWidgetBuilderPlugin(),
            new WishlistWidgetBuilderPlugin(),
            new ProductReviewWidgetBuilderPlugin(),
            new ProductRelationWidgetBuilderPlugin(),
            new ProductCmsBlockWidgetBuilderPlugin(),
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
