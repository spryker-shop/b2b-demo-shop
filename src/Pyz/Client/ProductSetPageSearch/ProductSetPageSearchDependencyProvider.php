<?php

namespace Pyz\Client\ProductSetPageSearch;

use Spryker\Client\ProductSetPageSearch\Plugin\Elasticsearch\ResultFormatter\ProductSetPageSearchListResultFormatterPlugin;
use Spryker\Client\ProductSetPageSearch\ProductSetPageSearchDependencyProvider as SprykerProductSetPageSearchDependencyProvider;
use Spryker\Client\Search\Plugin\Elasticsearch\QueryExpander\LocalizedQueryExpanderPlugin;
use Spryker\Client\Search\Plugin\Elasticsearch\QueryExpander\StoreQueryExpanderPlugin;

class ProductSetPageSearchDependencyProvider extends SprykerProductSetPageSearchDependencyProvider
{

    /**
     * @return array
     */
    protected function getProductSetListResultFormatterPlugins()
    {
        return [
            new ProductSetPageSearchListResultFormatterPlugin(),
        ];
    }

    /**
     * @return array
     */
    protected function getProductSetListQueryExpanderPlugins()
    {
        return [
            new LocalizedQueryExpanderPlugin(),
            new StoreQueryExpanderPlugin(),
        ];
    }
}
