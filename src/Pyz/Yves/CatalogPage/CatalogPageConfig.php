<?php



declare(strict_types = 1);

namespace Pyz\Yves\CatalogPage;

use SprykerShop\Yves\CatalogPage\CatalogPageConfig as SprykerCatalogPageConfig;

class CatalogPageConfig extends SprykerCatalogPageConfig
{
    /**
     * @var bool
     */
    protected const IS_MINI_CART_ASYNC_MODE_ENABLED = true;

    /**
     * @return bool
     */
    public function isVisibleEmptyRangeFilters(): bool
    {
        return false;
    }
}
