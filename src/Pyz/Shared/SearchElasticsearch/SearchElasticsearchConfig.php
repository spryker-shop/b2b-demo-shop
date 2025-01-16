<?php



declare(strict_types = 1);

namespace Pyz\Shared\SearchElasticsearch;

use Spryker\Shared\SearchElasticsearch\SearchElasticsearchConfig as SprykerSearchElasticsearchConfig;

class SearchElasticsearchConfig extends SprykerSearchElasticsearchConfig
{
    /**
     * @var array<string>
     */
    protected const SUPPORTED_SOURCE_IDENTIFIERS = [
        'page',
        'product-review',
        'return_reason',
        'merchant',
    ];
}
