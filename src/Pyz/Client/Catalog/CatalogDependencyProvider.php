<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Catalog;

use Generated\Shared\Transfer\SearchContextTransfer;
use Generated\Shared\Transfer\SearchHttpSearchContextTransfer;
use Spryker\Client\Catalog\CatalogDependencyProvider as SprykerCatalogDependencyProvider;
use Spryker\Client\Catalog\Plugin\ConfigTransferBuilder\AscendingNameSortConfigTransferBuilderPlugin;
use Spryker\Client\Catalog\Plugin\ConfigTransferBuilder\CategoryFacetConfigTransferBuilderPlugin;
use Spryker\Client\Catalog\Plugin\ConfigTransferBuilder\DescendingNameSortConfigTransferBuilderPlugin;
use Spryker\Client\Catalog\Plugin\Elasticsearch\Query\ProductCatalogSearchQueryPlugin;
use Spryker\Client\Catalog\Plugin\Elasticsearch\QueryExpander\PaginatedProductConcreteCatalogSearchQueryExpanderPlugin;
use Spryker\Client\Catalog\Plugin\Elasticsearch\ResultFormatter\ProductConcreteCatalogSearchResultFormatterPlugin;
use Spryker\Client\Catalog\Plugin\Elasticsearch\ResultFormatter\RawCatalogSearchResultFormatterPlugin;
use Spryker\Client\CatalogPriceProductConnector\Plugin\Catalog\QueryExpander\ProductPriceSearchHttpQueryExpanderPlugin;
use Spryker\Client\CatalogPriceProductConnector\Plugin\Catalog\ResultFormatter\CurrencyAwareCatalogSearchHttpResultFormatterPlugin;
use Spryker\Client\CatalogPriceProductConnector\Plugin\ConfigTransferBuilder\AscendingPriceSortConfigTransferBuilderPlugin;
use Spryker\Client\CatalogPriceProductConnector\Plugin\ConfigTransferBuilder\DescendingPriceSortConfigTransferBuilderPlugin;
use Spryker\Client\CatalogPriceProductConnector\Plugin\ConfigTransferBuilder\PriceFacetConfigTransferBuilderPlugin;
use Spryker\Client\CatalogPriceProductConnector\Plugin\CurrencyAwareCatalogSearchResultFormatterPlugin;
use Spryker\Client\CatalogPriceProductConnector\Plugin\CurrencyAwareSuggestionByTypeResultFormatter;
use Spryker\Client\CatalogPriceProductConnector\Plugin\ProductPriceQueryExpanderPlugin;
use Spryker\Client\CategoryStorage\Plugin\Catalog\ResultFormatter\CategoryTreeFilterSearchHttpResultFormatterPlugin;
use Spryker\Client\CategoryStorage\Plugin\Elasticsearch\ResultFormatter\CategoryTreeFilterPageSearchResultFormatterPlugin;
use Spryker\Client\CustomerCatalog\Plugin\Search\ProductListQueryExpanderPlugin as CustomerCatalogProductListQueryExpanderPlugin;
use Spryker\Client\ProductLabelStorage\Plugin\Catalog\ProductLabelSearchHttpFacetConfigTransferBuilderPlugin;
use Spryker\Client\ProductLabelStorage\Plugin\ProductLabelFacetConfigTransferBuilderPlugin;
use Spryker\Client\ProductListSearch\Plugin\Search\ProductListQueryExpanderPlugin as ProductListSearchProductListQueryExpanderPlugin;
use Spryker\Client\ProductReview\Plugin\RatingFacetConfigTransferBuilderPlugin;
use Spryker\Client\ProductReview\Plugin\RatingSortConfigTransferBuilderPlugin;
use Spryker\Client\Search\Dependency\Plugin\QueryInterface;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\CompletionQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\FacetQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\IsActiveInDateRangeQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\IsActiveQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\LocalizedQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\PaginatedQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\SortedCategoryQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\SortedQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\SpellingSuggestionQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\StoreQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\SuggestionByTypeQueryExpanderPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\CompletionResultFormatterPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\FacetResultFormatterPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\PaginatedResultFormatterPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\SortedResultFormatterPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\SpellingSuggestionResultFormatterPlugin;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\SuggestionByTypeResultFormatterPlugin;
use Spryker\Client\SearchHttp\Plugin\Catalog\Query\SearchHttpQueryPlugin;
use Spryker\Client\SearchHttp\Plugin\Catalog\QueryExpander\BasicSearchHttpQueryExpanderPlugin;
use Spryker\Client\SearchHttp\Plugin\Catalog\QueryExpander\FacetSearchHttpQueryExpanderPlugin;
use Spryker\Client\SearchHttp\Plugin\Catalog\ResultFormatter\FacetSearchHttpResultFormatterPlugin;
use Spryker\Client\SearchHttp\Plugin\Catalog\ResultFormatter\PaginationSearchHttpResultFormatterPlugin;
use Spryker\Client\SearchHttp\Plugin\Catalog\ResultFormatter\ProductSearchHttpResultFormatterPlugin;
use Spryker\Client\SearchHttp\Plugin\Catalog\ResultFormatter\SortSearchHttpResultFormatterPlugin;
use Spryker\Client\SearchHttp\Plugin\Catalog\ResultFormatter\SpellingSuggestionSearchHttpResultFormatterPlugin;
use Spryker\Shared\SearchHttp\SearchHttpConfig;

class CatalogDependencyProvider extends SprykerCatalogDependencyProvider
{
    /**
     * @return array<\Spryker\Client\Catalog\Dependency\Plugin\FacetConfigTransferBuilderPluginInterface>
     */
    protected function getFacetConfigTransferBuilderPlugins(): array
    {
        return [
            new CategoryFacetConfigTransferBuilderPlugin(),
            new RatingFacetConfigTransferBuilderPlugin(),
            new ProductLabelFacetConfigTransferBuilderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Client\Catalog\Dependency\Plugin\SortConfigTransferBuilderPluginInterface>
     */
    protected function getSortConfigTransferBuilderPlugins(): array
    {
        return [
            new RatingSortConfigTransferBuilderPlugin(),
            new AscendingNameSortConfigTransferBuilderPlugin(),
            new DescendingNameSortConfigTransferBuilderPlugin(),
            new AscendingPriceSortConfigTransferBuilderPlugin(),
            new DescendingPriceSortConfigTransferBuilderPlugin(),
        ];
    }

    /**
     * @phpstan-return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected function createCatalogSearchQueryPlugin(): QueryInterface
    {
        return new ProductCatalogSearchQueryPlugin();
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface>|array<\Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    protected function createCatalogSearchQueryExpanderPlugins(): array
    {
        return [
            new StoreQueryExpanderPlugin(),
            new LocalizedQueryExpanderPlugin(),
            new ProductPriceQueryExpanderPlugin(),
            new SortedQueryExpanderPlugin(),
            new SortedCategoryQueryExpanderPlugin(CategoryFacetConfigTransferBuilderPlugin::PARAMETER_NAME),
            new PaginatedQueryExpanderPlugin(),
            new SpellingSuggestionQueryExpanderPlugin(),
            new IsActiveQueryExpanderPlugin(),
            new IsActiveInDateRangeQueryExpanderPlugin(),
            new CustomerCatalogProductListQueryExpanderPlugin(),

            /*
             * FacetQueryExpanderPlugin needs to be after other query expanders which filters down the results.
             */
            new FacetQueryExpanderPlugin(),
        ];
    }

    /**
     * @phpstan-return array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     *
     * @return array<\Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface|\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    protected function createCatalogSearchResultFormatterPlugins(): array
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
            new SpellingSuggestionResultFormatterPlugin(),
            new CategoryTreeFilterPageSearchResultFormatterPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface>|array<\Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    protected function createSuggestionQueryExpanderPlugins(): array
    {
        return [
            new StoreQueryExpanderPlugin(),
            new LocalizedQueryExpanderPlugin(),
            new CompletionQueryExpanderPlugin(),
            new SuggestionByTypeQueryExpanderPlugin(),
            new IsActiveQueryExpanderPlugin(),
            new IsActiveInDateRangeQueryExpanderPlugin(),
            new CustomerCatalogProductListQueryExpanderPlugin(),
        ];
    }

    /**
     * @phpstan-return array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     *
     * @return array<\Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface|\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    protected function createSuggestionResultFormatterPlugins(): array
    {
        /** @phpstan-var \Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface $rawCatalogSearchResultFormatterPlugin */
        $rawCatalogSearchResultFormatterPlugin = new SuggestionByTypeResultFormatterPlugin();

        return [
            new CompletionResultFormatterPlugin(),
            new CurrencyAwareSuggestionByTypeResultFormatter(
                $rawCatalogSearchResultFormatterPlugin,
            ),
        ];
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface>|array<\Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    protected function createCatalogSearchCountQueryExpanderPlugins(): array
    {
        return [
            new StoreQueryExpanderPlugin(),
            new LocalizedQueryExpanderPlugin(),
            new ProductPriceQueryExpanderPlugin(),
            new IsActiveQueryExpanderPlugin(),
            new IsActiveInDateRangeQueryExpanderPlugin(),
            new CustomerCatalogProductListQueryExpanderPlugin(),
        ];
    }

    /**
     * @phpstan-return array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     *
     * @return array<\Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface|\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    protected function getProductConcreteCatalogSearchResultFormatterPlugins(): array
    {
        return [
            new ProductConcreteCatalogSearchResultFormatterPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface>|array<\Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    protected function getProductConcreteCatalogSearchQueryExpanderPlugins(): array
    {
        return [
            new LocalizedQueryExpanderPlugin(),
            new PaginatedProductConcreteCatalogSearchQueryExpanderPlugin(),
            new CustomerCatalogProductListQueryExpanderPlugin(),
            new ProductListSearchProductListQueryExpanderPlugin(),
        ];
    }

    /**
     * @return array<string, array<\Spryker\Client\Catalog\Dependency\Plugin\FacetConfigTransferBuilderPluginInterface>>
     */
    protected function getFacetConfigTransferBuilderPluginVariants(): array
    {
        return [
            SearchHttpConfig::TYPE_SEARCH_HTTP => [
                new CategoryFacetConfigTransferBuilderPlugin(),
                new PriceFacetConfigTransferBuilderPlugin(),
                new RatingFacetConfigTransferBuilderPlugin(),
                new ProductLabelSearchHttpFacetConfigTransferBuilderPlugin(),
            ],
        ];
    }

    /**
     * @phpstan-return array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface>
     *
     * @return array<\Spryker\Client\Search\Dependency\Plugin\QueryInterface>
     */
    protected function createCatalogSearchQueryPluginVariants(): array
    {
        $searchContextTransfer = (new SearchContextTransfer())
            ->setSourceIdentifier(SearchHttpConfig::SOURCE_IDENTIFIER_PRODUCT)
            ->setSearchHttpContext(new SearchHttpSearchContextTransfer());

        return [
            new SearchHttpQueryPlugin($searchContextTransfer),
        ];
    }

    /**
     * @return array<string, array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface>>
     */
    protected function createCatalogSearchQueryExpanderPluginVariants(): array
    {
        return [
            SearchHttpConfig::TYPE_SEARCH_HTTP => [
                new BasicSearchHttpQueryExpanderPlugin(),
                new ProductPriceSearchHttpQueryExpanderPlugin(),
                new FacetSearchHttpQueryExpanderPlugin(),
            ],
        ];
    }

    /**
     * @return array<string, array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>>
     */
    protected function createCatalogSearchResultFormatterPluginVariants(): array
    {
        return [
            SearchHttpConfig::TYPE_SEARCH_HTTP => [
                new PaginationSearchHttpResultFormatterPlugin(),
                new SortSearchHttpResultFormatterPlugin(),
                new CurrencyAwareCatalogSearchHttpResultFormatterPlugin(
                    new ProductSearchHttpResultFormatterPlugin(),
                ),
                new SpellingSuggestionSearchHttpResultFormatterPlugin(),
                new FacetSearchHttpResultFormatterPlugin(),
                new CategoryTreeFilterSearchHttpResultFormatterPlugin(),
            ],
        ];
    }
}
