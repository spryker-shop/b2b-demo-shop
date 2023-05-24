<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\ExampleProductSalePage;

use Pyz\Client\ExampleProductSalePage\Plugin\Elasticsearch\Query\SaleSearchQueryPlugin;
use Spryker\Client\Catalog\Plugin\Elasticsearch\ResultFormatter\RawCatalogSearchResultFormatterPlugin;
use Spryker\Client\CatalogPriceProductConnector\Plugin\CurrencyAwareCatalogSearchResultFormatterPlugin;
use Spryker\Client\CatalogPriceProductConnector\Plugin\ProductPriceQueryExpanderPlugin;
use Spryker\Client\CustomerCatalog\Plugin\Search\ProductListQueryExpanderPlugin;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;
use Spryker\Client\Search\SearchClient;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\FacetQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\LocalizedQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\PaginatedQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\SortedQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\StoreQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\FacetResultFormatterPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\PaginatedResultFormatterPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\SortedResultFormatterPlugin;

class ExampleProductSalePageDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const PYZ_CLIENT_SEARCH = 'PYZ_CLIENT_SEARCH';

    /**
     * @var string
     */
    public const PYZ_CLIENT_PRODUCT_LABEL_STORAGE = 'PYZ_CLIENT_PRODUCT_LABEL_STORAGE';

    /**
     * @var string
     */
    public const PYZ_SALE_SEARCH_QUERY_PLUGIN = 'PYZ_SALE_SEARCH_QUERY_PLUGIN';

    /**
     * @var string
     */
    public const PYZ_SALE_SEARCH_QUERY_EXPANDER_PLUGINS = 'PYZ_SALE_SEARCH_QUERY_EXPANDER_PLUGINS';

    /**
     * @var string
     */
    public const PYZ_SALE_SEARCH_RESULT_FORMATTER_PLUGINS = 'PYZ_SALE_SEARCH_RESULT_FORMATTER_PLUGINS';

    /**
     * @var string
     */
    public const PYZ_CLIENT_STORE = 'PYZ_CLIENT_STORE';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);
        $container = $this->addPyzSearchClient($container);
        $container = $this->addPyzProductLabelClient($container);
        $container = $this->addPyzSaleSearchQueryPlugin($container);
        $container = $this->addSaleSearchQueryExpanderPlugins($container);
        $container = $this->addSaleSearchResultFormatterPlugins($container);
        $container = $this->addPyzClientStore($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPyzSearchClient(Container $container): Container
    {
        $container->set(static::PYZ_CLIENT_SEARCH, function () {
            return new SearchClient();
        });

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPyzProductLabelClient(Container $container): Container
    {
        $container->set(static::PYZ_CLIENT_PRODUCT_LABEL_STORAGE, function (Container $container) {
            return $container->getLocator()->productLabelStorage()->client();
        });

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPyzSaleSearchQueryPlugin(Container $container): Container
    {
        $container->set(static::PYZ_SALE_SEARCH_QUERY_PLUGIN, function () {
            return new SaleSearchQueryPlugin();
        });

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addSaleSearchQueryExpanderPlugins(Container $container): Container
    {
        $container->set(static::PYZ_SALE_SEARCH_QUERY_EXPANDER_PLUGINS, function () {
            return $this->getSaleSearchQueryExpanderPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    protected function getSaleSearchQueryExpanderPlugins(): array
    {
        return [
            new StoreQueryExpanderPlugin(),
            new LocalizedQueryExpanderPlugin(),
            new ProductPriceQueryExpanderPlugin(),
            new SortedQueryExpanderPlugin(),
            new PaginatedQueryExpanderPlugin(),
            new ProductListQueryExpanderPlugin(),

            /*
             * FacetQueryExpanderPlugin needs to be after other query expanders which filters down the results.
             */
            new FacetQueryExpanderPlugin(),
        ];
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addSaleSearchResultFormatterPlugins(Container $container): Container
    {
        $container->set(static::PYZ_SALE_SEARCH_RESULT_FORMATTER_PLUGINS, function () {
            return $this->getSaleSearchResultFormatterPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface|\Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    protected function getSaleSearchResultFormatterPlugins(): array
    {
        /** @phpstan-var \Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface $rawCatalogSearchResultFormatterPlugin */
        $rawCatalogSearchResultFormatterPlugin = new RawCatalogSearchResultFormatterPlugin();

        return [
            new FacetResultFormatterPlugin(),
            new SortedResultFormatterPlugin(),
            new PaginatedResultFormatterPlugin(),
            new CurrencyAwareCatalogSearchResultFormatterPlugin(
                $rawCatalogSearchResultFormatterPlugin,
            ),
        ];
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addPyzClientStore(Container $container): Container
    {
        $container->set(static::PYZ_CLIENT_STORE, function (Container $container) {
            return $container->getLocator()->store()->client();
        });

        return $container;
    }
}
