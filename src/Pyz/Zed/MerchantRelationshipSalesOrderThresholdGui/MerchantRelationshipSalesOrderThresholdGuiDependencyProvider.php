<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\MerchantRelationshipSalesOrderThresholdGui;

use Spryker\Zed\MerchantRelationshipSalesOrderThresholdGui\Communication\Plugin\FormExpander\MerchantRelationshipHardMaximumThresholdFormExpanderPlugin;
use Spryker\Zed\MerchantRelationshipSalesOrderThresholdGui\Communication\Plugin\FormExpander\MerchantRelationshipHardThresholdFormExpanderPlugin;
use Spryker\Zed\MerchantRelationshipSalesOrderThresholdGui\Communication\Plugin\FormExpander\MerchantRelationshipSoftThresholdFixedFeeFormExpanderPlugin;
use Spryker\Zed\MerchantRelationshipSalesOrderThresholdGui\Communication\Plugin\FormExpander\MerchantRelationshipSoftThresholdFlexibleFeeFormExpanderPlugin;
use Spryker\Zed\MerchantRelationshipSalesOrderThresholdGui\Communication\Plugin\FormExpander\MerchantRelationshipSoftThresholdWithMessageFormExpanderPlugin;
use Spryker\Zed\MerchantRelationshipSalesOrderThresholdGui\MerchantRelationshipSalesOrderThresholdGuiDependencyProvider as SprykerMerchantRelationshipSalesOrderThresholdGuiDependencyProvider;

class MerchantRelationshipSalesOrderThresholdGuiDependencyProvider extends SprykerMerchantRelationshipSalesOrderThresholdGuiDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\MerchantRelationshipSalesOrderThresholdGuiExtension\Dependency\Plugin\SalesOrderThresholdFormExpanderPluginInterface>
     */
    protected function getSalesOrderThresholdFormExpanderPlugins(): array
    {
        return [
            new MerchantRelationshipHardThresholdFormExpanderPlugin(),
            new MerchantRelationshipSoftThresholdWithMessageFormExpanderPlugin(),
            new MerchantRelationshipSoftThresholdFixedFeeFormExpanderPlugin(),
            new MerchantRelationshipSoftThresholdFlexibleFeeFormExpanderPlugin(),
            new MerchantRelationshipHardMaximumThresholdFormExpanderPlugin(),
        ];
    }
}
