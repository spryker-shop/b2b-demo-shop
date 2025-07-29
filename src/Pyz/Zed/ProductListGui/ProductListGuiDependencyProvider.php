<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ProductListGui;

use Spryker\Zed\ConfigurableBundleGui\Communication\Plugin\ProductListGui\ConfigurableBundleTemplateListProductListTopButtonsExpanderPlugin;
use Spryker\Zed\ConfigurableBundleGui\Communication\Plugin\ProductListGui\ConfigurableBundleTemplateProductListUsedByTableExpanderPlugin;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\Plugin\ProductListGui\MerchantRelationListProductListTopButtonsExpanderPlugin;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\Plugin\ProductListGui\MerchantRelationshipProductListUsedByTableExpanderPlugin;
use Spryker\Zed\ProductListGui\ProductListGuiDependencyProvider as SprykerProductListGuiDependencyProvider;

class ProductListGuiDependencyProvider extends SprykerProductListGuiDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\ProductListGuiExtension\Dependency\Plugin\ProductListTopButtonsExpanderPluginInterface>
     */
    protected function getProductListTopButtonsExpanderPlugins(): array
    {
        return [
            new ConfigurableBundleTemplateListProductListTopButtonsExpanderPlugin(),
            new MerchantRelationListProductListTopButtonsExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductListGuiExtension\Dependency\Plugin\ProductListUsedByTableExpanderPluginInterface>
     */
    protected function getProductListUsedByTableExpanderPlugins(): array
    {
        return [
            new ConfigurableBundleTemplateProductListUsedByTableExpanderPlugin(),
            new MerchantRelationshipProductListUsedByTableExpanderPlugin(),
        ];
    }
}
