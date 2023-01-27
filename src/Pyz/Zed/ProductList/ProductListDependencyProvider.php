<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductList;

use Spryker\Zed\ConfigurableBundle\Communication\Plugin\ProductList\ConfigurableBundleTemplateSlotProductListDeletePreCheckPlugin;
use Spryker\Zed\MerchantRelationshipProductList\Communication\Plugin\ProductList\MerchantRelationshipProductListDeletePreCheckPlugin;
use Spryker\Zed\ProductBundleProductListConnector\Communication\Plugin\ProductList\ProductBundleProductListPreCreatePlugin;
use Spryker\Zed\ProductBundleProductListConnector\Communication\Plugin\ProductList\ProductBundleProductListPreUpdatePlugin;
use Spryker\Zed\ProductList\ProductListDependencyProvider as SprykerProductListDependencyProvider;

class ProductListDependencyProvider extends SprykerProductListDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\ProductListExtension\Dependency\Plugin\ProductListPreCreatePluginInterface>
     */
    protected function getProductListPreCreatePlugins(): array
    {
        return [
            new ProductBundleProductListPreCreatePlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductListExtension\Dependency\Plugin\ProductListPreUpdatePluginInterface>
     */
    protected function getProductListPreUpdatePlugins(): array
    {
        return [
            new ProductBundleProductListPreUpdatePlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductListExtension\Dependency\Plugin\ProductListDeletePreCheckPluginInterface>
     */
    protected function getProductListDeletePreCheckPlugins(): array
    {
        return [
            new ConfigurableBundleTemplateSlotProductListDeletePreCheckPlugin(),
            new MerchantRelationshipProductListDeletePreCheckPlugin(),
        ];
    }
}
