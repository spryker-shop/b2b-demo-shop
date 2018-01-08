<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Client\ProductRelationStorage;

use Spryker\Client\PriceProductStorage\Plugin\ProductViewPriceExpanderPlugin;
use Spryker\Client\ProductImageStorage\Plugin\ProductViewImageExpanderPlugin;
use Spryker\Client\ProductRelationStorage\ProductRelationStorageDependencyProvider as SprykerProductRelationStorageDependencyProvider;
use Spryker\Client\ProductStorage\Dependency\Plugin\ProductViewExpanderPluginInterface;

class ProductRelationStorageDependencyProvider extends SprykerProductRelationStorageDependencyProvider
{
    /**
     * @return ProductViewExpanderPluginInterface[]
     */
    protected function getRelatedProductExpanderPlugins()
    {
        return [
            new ProductViewPriceExpanderPlugin(),
            new ProductViewImageExpanderPlugin(),
        ];
    }
}
