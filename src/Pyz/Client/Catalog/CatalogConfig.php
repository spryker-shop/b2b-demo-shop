<?php



declare(strict_types = 1);

namespace Pyz\Client\Catalog;

use Spryker\Client\Catalog\CatalogConfig as SprykerCatalogConfig;

class CatalogConfig extends SprykerCatalogConfig
{
    /**
     * @var array<int>
     */
    protected const PAGINATION_VALID_ITEMS_PER_PAGE = [
        10,
        1000,
    ];

    /**
     * @var int
     */
    protected const PAGINATION_CATALOG_SEARCH_DEFAULT_ITEMS_PER_PAGE = 12;
}
