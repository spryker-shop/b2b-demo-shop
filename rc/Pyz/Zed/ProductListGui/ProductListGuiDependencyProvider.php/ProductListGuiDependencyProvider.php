<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductListGui;

use Spryker\Zed\MerchantRelationshipProductListGui\Communication\Plugin\ProductListFormMerchantRelationExpanderPlugin;
use Spryker\Zed\ProductListGui\ProductListGuiDependencyProvider as SprykerProductListGuiDependencyProvider;

class ProductListGuiDependencyProvider extends SprykerProductListGuiDependencyProvider
{
    /**
     * @return \Spryker\Zed\ProductListGuiExtension\Dependency\Plugin\ProductListCreateFormExpanderPluginInterface[]
     */
    protected function getProductListCreateFormExpanderPlugins(): array
    {
        return [
            new ProductListFormMerchantRelationExpanderPlugin(),
        ];
    }
}
