<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ProductNewPage;

use SprykerShop\Yves\ProductNewPage\ProductNewPageDependencyProvider as SprykerShopProductNewPageDependencyProvider;

class ProductNewPageDependencyProvider extends SprykerShopProductNewPageDependencyProvider
{
    /**
     * @return string[]
     */
    protected function getProductNewPageWidgetPlugins(): array
    {
        return [];
    }
}
