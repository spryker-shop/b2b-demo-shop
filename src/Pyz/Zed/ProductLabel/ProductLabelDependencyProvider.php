<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ProductLabel;

use Pyz\Zed\ExampleProductSalePage\Communication\Plugin\ExampleProductSalePageLabelUpdaterPlugin;
use Spryker\Zed\ProductAlternativeProductLabelConnector\Communication\Plugin\ProductAlternativeLabelUpdaterPlugin;
use Spryker\Zed\ProductDiscontinuedProductLabelConnector\Communication\Plugin\ProductDiscontinuedLabelUpdaterPlugin;
use Spryker\Zed\ProductLabel\ProductLabelDependencyProvider as SprykerProductLabelDependencyProvider;
use Spryker\Zed\ProductNew\Communication\Plugin\ProductNewLabelUpdaterPlugin;

class ProductLabelDependencyProvider extends SprykerProductLabelDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\ProductLabel\Dependency\Plugin\ProductLabelRelationUpdaterPluginInterface>
     */
    protected function getProductLabelRelationUpdaterPlugins(): array
    {
        return [
            new ProductNewLabelUpdaterPlugin(),
            new ExampleProductSalePageLabelUpdaterPlugin(),
            new ProductAlternativeLabelUpdaterPlugin(),
            new ProductDiscontinuedLabelUpdaterPlugin(),
        ];
    }
}
