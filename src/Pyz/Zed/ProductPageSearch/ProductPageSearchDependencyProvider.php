<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductPageSearch;

use Spryker\Shared\ProductLabelSearch\ProductLabelSearchConfig;
use Spryker\Shared\ProductListSearch\ProductListSearchConfig;
use Spryker\Shared\ProductPageSearch\ProductPageSearchConfig;
use Spryker\Shared\ProductReviewSearch\ProductReviewSearchConfig;
use Spryker\Zed\Availability\Communication\Plugin\ProductPageSearch\AvailabilityProductAbstractAddToCartPlugin;
use Spryker\Zed\ProductCategorySearch\Communication\Plugin\ProductPageSearch\Elasticsearch\ProductCategoryMapExpanderPlugin;
use Spryker\Zed\ProductCategorySearch\Communication\Plugin\ProductPageSearch\ProductCategoryPageDataExpanderPlugin;
use Spryker\Zed\ProductCategorySearch\Communication\Plugin\ProductPageSearch\ProductCategoryPageDataLoaderPlugin;
use Spryker\Zed\ProductLabelSearch\Communication\Plugin\PageDataExpander\ProductLabelDataLoaderExpanderPlugin;
use Spryker\Zed\ProductLabelSearch\Communication\Plugin\PageDataLoader\ProductLabelDataLoaderPlugin;
use Spryker\Zed\ProductLabelSearch\Communication\Plugin\ProductPageSearch\Elasticsearch\ProductLabelMapExpanderPlugin;
use Spryker\Zed\ProductListSearch\Communication\Plugin\ProductPageSearch\DataExpander\ProductListDataLoadExpanderPlugin;
use Spryker\Zed\ProductListSearch\Communication\Plugin\ProductPageSearch\DataLoader\ProductListDataLoaderPlugin;
use Spryker\Zed\ProductListSearch\Communication\Plugin\ProductPageSearch\Elasticsearch\ProductListMapExpanderPlugin;
use Spryker\Zed\ProductListSearch\Communication\Plugin\ProductPageSearch\ProductConcreteProductListPageDataExpanderPlugin;
use Spryker\Zed\ProductListSearch\Communication\Plugin\ProductPageSearch\ProductConcreteProductListPageMapExpanderPlugin;
use Spryker\Zed\ProductMeasurementUnit\Communication\Plugin\ProductPageSearch\ProductMeasurementUnitProductAbstractAddToCartPlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\ProductPageSearch\ProductPackagingUnitProductAbstractAddToCartPlugin;
use Spryker\Zed\ProductPageSearch\Communication\Plugin\PageDataExpander\PricePageDataLoaderExpanderPlugin;
use Spryker\Zed\ProductPageSearch\Communication\Plugin\PageDataExpander\ProductImagePageDataLoaderExpanderPlugin;
use Spryker\Zed\ProductPageSearch\Communication\Plugin\PageDataExpander\ProductImageProductConcretePageDataExpanderPlugin;
use Spryker\Zed\ProductPageSearch\Communication\Plugin\PageDataLoader\ImagePageDataLoaderPlugin;
use Spryker\Zed\ProductPageSearch\Communication\Plugin\PageDataLoader\PriceProductPageDataLoaderPlugin;
use Spryker\Zed\ProductPageSearch\Communication\Plugin\PageMapExpander\ProductImageProductConcretePageMapExpanderPlugin;
use Spryker\Zed\ProductPageSearch\Communication\Plugin\ProductPageSearch\Elasticsearch\ProductImageMapExpanderPlugin;
use Spryker\Zed\ProductPageSearch\Communication\Plugin\ProductPageSearch\Elasticsearch\ProductPriceMapExpanderPlugin;
use Spryker\Zed\ProductPageSearch\ProductPageSearchDependencyProvider as SprykerProductPageSearchDependencyProvider;
use Spryker\Zed\ProductReviewSearch\Communication\Plugin\PageDataExpander\ProductReviewDataLoaderExpanderPlugin;
use Spryker\Zed\ProductReviewSearch\Communication\Plugin\PageDataLoader\ProductReviewPageDataLoaderPlugin;
use Spryker\Zed\ProductReviewSearch\Communication\Plugin\ProductPageSearch\Elasticsearch\ProductReviewMapExpanderPlugin;
use Spryker\Zed\SalesProductConnector\Communication\Plugin\ProductPageSearch\ProductListWasBoughtByIntervalPlugin;
use Spryker\Zed\SalesProductConnector\Communication\Plugin\ProductPageSearch\ProductPopularityMapExpanderPlugin;
use Spryker\Zed\SalesProductConnector\Communication\Plugin\ProductPageSearch\ProductPopularityPageDataLoaderPlugin;

class ProductPageSearchDependencyProvider extends SprykerProductPageSearchDependencyProvider
{
    /**
     * @var string
     */
    public const PYZ_PLUGIN_PRODUCT_LABEL_DATA = 'PYZ_PLUGIN_PRODUCT_LABEL_DATA';

    /**
     * @return \Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageDataExpanderInterface[]
     */
    protected function getDataExpanderPlugins(): array
    {
        $dataExpanderPlugins = [];

        $dataExpanderPlugins[ProductLabelSearchConfig::PLUGIN_PRODUCT_LABEL_DATA] = new ProductLabelDataLoaderExpanderPlugin();
        $dataExpanderPlugins[ProductReviewSearchConfig::PLUGIN_PRODUCT_PAGE_RATING_DATA] = new ProductReviewDataLoaderExpanderPlugin();
        $dataExpanderPlugins[ProductListSearchConfig::PLUGIN_PRODUCT_LIST_DATA] = new ProductListDataLoadExpanderPlugin();
        $dataExpanderPlugins[ProductPageSearchConfig::PLUGIN_PRODUCT_CATEGORY_PAGE_DATA] = new ProductCategoryPageDataExpanderPlugin();
        $dataExpanderPlugins[ProductPageSearchConfig::PLUGIN_PRODUCT_PRICE_PAGE_DATA] = new PricePageDataLoaderExpanderPlugin();
        $dataExpanderPlugins[ProductPageSearchConfig::PLUGIN_PRODUCT_IMAGE_PAGE_DATA] = new ProductImagePageDataLoaderExpanderPlugin();

        return $dataExpanderPlugins;
    }

    /**
     * @return \Spryker\Zed\ProductPageSearchExtension\Dependency\Plugin\ProductPageDataLoaderPluginInterface[]
     */
    protected function getDataLoaderPlugins(): array
    {
        return [
            new ImagePageDataLoaderPlugin(),
            new ProductCategoryPageDataLoaderPlugin(),
            new PriceProductPageDataLoaderPlugin(),
            new ProductLabelDataLoaderPlugin(),
            new ProductReviewPageDataLoaderPlugin(),
            new ProductListDataLoaderPlugin(),
            new ProductPopularityPageDataLoaderPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\ProductPageSearchExtension\Dependency\Plugin\ProductConcretePageMapExpanderPluginInterface[]
     */
    protected function getConcreteProductMapExpanderPlugins(): array
    {
        return [
            new ProductConcreteProductListPageMapExpanderPlugin(),
            new ProductImageProductConcretePageMapExpanderPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\ProductPageSearchExtension\Dependency\Plugin\ProductConcretePageDataExpanderPluginInterface[]
     */
    protected function getProductConcretePageDataExpanderPlugins(): array
    {
        return [
            new ProductConcreteProductListPageDataExpanderPlugin(),
            new ProductImageProductConcretePageDataExpanderPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\ProductPageSearchExtension\Dependency\Plugin\ProductAbstractMapExpanderPluginInterface[]
     */
    protected function getProductAbstractMapExpanderPlugins(): array
    {
        return [
            new ProductPriceMapExpanderPlugin(),
            new ProductCategoryMapExpanderPlugin(),
            new ProductImageMapExpanderPlugin(),
            new ProductLabelMapExpanderPlugin(),
            new ProductReviewMapExpanderPlugin(),
            new ProductListMapExpanderPlugin(),
            new ProductPopularityMapExpanderPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\ProductPageSearchExtension\Dependency\Plugin\ProductAbstractAddToCartPluginInterface[]
     */
    protected function getProductAbstractAddToCartPlugins(): array
    {
        return [
            new ProductMeasurementUnitProductAbstractAddToCartPlugin(),
            new ProductPackagingUnitProductAbstractAddToCartPlugin(),
            new AvailabilityProductAbstractAddToCartPlugin(),
        ];
    }
    /**
     * @return array<\Spryker\Zed\ProductPageSearchExtension\Dependency\Plugin\ProductAbstractCollectionRefreshPluginInterface>
     */
    protected function getProductPageRefreshPlugins() : array
    {
        return [
            new ProductListWasBoughtByIntervalPlugin(),
        ];
    }
}
