<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Client\SelfServicePortal;

use SprykerFeature\Client\SelfServicePortal\Plugin\Elasticsearch\Query\SspAssetSearchQueryExpanderPlugin;
use SprykerFeature\Client\SelfServicePortal\Plugin\Elasticsearch\ResultFormatter\SspAssetSearchResultFormatterPlugin;
use SprykerFeature\Client\SelfServicePortal\SelfServicePortalDependencyProvider as SprykerSelfServicePortalDependencyProvider;

class SelfServicePortalDependencyProvider extends SprykerSelfServicePortalDependencyProvider
{
    /**
     * @return list<\Spryker\Client\SearchExtension\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    protected function getSspAssetSearchResultFormatterPlugins(): array
    {
        return [
            new SspAssetSearchResultFormatterPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    protected function getSspAssetSearchQueryExpanderPlugins(): array
    {
        return [
            new SspAssetSearchQueryExpanderPlugin(),
        ];
    }
}
