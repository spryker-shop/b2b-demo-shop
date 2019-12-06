<?php

namespace Pyz\Client\Catalog;

use Spryker\Client\Catalog\CatalogConfig as SprykerCatalogConfig;

class CatalogConfig extends SprykerCatalogConfig
{
    protected const PAGINATION_VALID_ITEMS_PER_PAGE = [
        10,
        1000,
    ];
}
