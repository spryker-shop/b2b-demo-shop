<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\MerchantRelationshipGui;

use Spryker\Zed\MerchantRelationshipGui\MerchantRelationshipGuiDependencyProvider as SprykerMerchantRelationshipGuiDependencyProvider;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\Plugin\MerchantRelationshipGui\ProductListMerchantRelationshipCreateFormExpanderPlugin;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\Plugin\MerchantRelationshipGui\ProductListMerchantRelationshipEditFormExpanderPlugin;

class MerchantRelationshipGuiDependencyProvider extends SprykerMerchantRelationshipGuiDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\MerchantRelationshipGuiExtension\Dependency\Plugin\MerchantRelationshipCreateFormExpanderPluginInterface>
     */
    protected function getMerchantRelationshipCreateFormExpanderPlugins(): array
    {
        return [
            new ProductListMerchantRelationshipCreateFormExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\MerchantRelationshipGuiExtension\Dependency\Plugin\MerchantRelationshipEditFormExpanderPluginInterface>
     */
    protected function getMerchantRelationshipEditFormExpanderPlugins(): array
    {
        return [
            new ProductListMerchantRelationshipEditFormExpanderPlugin(),
        ];
    }
}
