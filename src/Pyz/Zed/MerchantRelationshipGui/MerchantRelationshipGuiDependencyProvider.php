<?php



declare(strict_types = 1);

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
