<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Client\ServicePointSearch;

use Spryker\Client\ServicePointSearch\Plugin\Elasticsearch\Query\PaginatedServicePointSearchQueryExpanderPlugin;
use Spryker\Client\ServicePointSearch\Plugin\Elasticsearch\Query\ServicePointAddressRelationExcludeServicePointQueryExpanderPlugin;
use Spryker\Client\ServicePointSearch\Plugin\Elasticsearch\Query\ServiceTypesServicePointSearchQueryExpanderPlugin;
use Spryker\Client\ServicePointSearch\Plugin\Elasticsearch\Query\SortedServicePointSearchQueryExpanderPlugin;
use Spryker\Client\ServicePointSearch\Plugin\Elasticsearch\Query\StoreServicePointSearchQueryExpanderPlugin;
use Spryker\Client\ServicePointSearch\Plugin\Elasticsearch\ResultFormatter\ServicePointSearchResultFormatterPlugin;
use Spryker\Client\ServicePointSearch\ServicePointSearchDependencyProvider as SprykerServicePointSearchDependencyProvider;

class ServicePointSearchDependencyProvider extends SprykerServicePointSearchDependencyProvider
{
    /**
     * @return list<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    protected function getServicePointSearchResultFormatterPlugins(): array
    {
        return [
            new ServicePointSearchResultFormatterPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    protected function getServicePointSearchQueryExpanderPlugins(): array
    {
        return [
            new StoreServicePointSearchQueryExpanderPlugin(),
            new SortedServicePointSearchQueryExpanderPlugin(),
            new PaginatedServicePointSearchQueryExpanderPlugin(),
            new ServiceTypesServicePointSearchQueryExpanderPlugin(),
            new ServicePointAddressRelationExcludeServicePointQueryExpanderPlugin(),
        ];
    }
}
