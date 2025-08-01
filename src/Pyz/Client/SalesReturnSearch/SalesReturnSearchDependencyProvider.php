<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Client\SalesReturnSearch;

use Spryker\Client\SalesReturnSearch\Plugin\Elasticsearch\Query\PaginatedReturnReasonSearchQueryExpanderPlugin;
use Spryker\Client\SalesReturnSearch\Plugin\Elasticsearch\ResultFormatter\ReturnReasonSearchResultFormatterPlugin;
use Spryker\Client\SalesReturnSearch\SalesReturnSearchDependencyProvider as SprykerSalesReturnSearchDependencyProvider;
use Spryker\Client\SearchElasticsearch\Plugin\QueryExpander\LocalizedQueryExpanderPlugin;

class SalesReturnSearchDependencyProvider extends SprykerSalesReturnSearchDependencyProvider
{
    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    protected function getReturnReasonSearchResultFormatterPlugins(): array
    {
        return [
            new ReturnReasonSearchResultFormatterPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    protected function getReturnReasonSearchQueryExpanderPlugins(): array
    {
        return [
            new LocalizedQueryExpanderPlugin(),
            new PaginatedReturnReasonSearchQueryExpanderPlugin(),
        ];
    }
}
