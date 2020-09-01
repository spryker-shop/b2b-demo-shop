<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Stock;

use Spryker\Zed\Availability\Communication\Plugin\AvailabilityHandlerPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\ProductBundle\Communication\Plugin\Stock\ProductBundleAvailabilityHandlerPlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\Stock\LeadProductStockUpdateHandlerPlugin;
use Spryker\Zed\Stock\StockDependencyProvider as SprykerStockDependencyProvider;

class StockDependencyProvider extends SprykerStockDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Stock\Dependency\Plugin\StockUpdateHandlerPluginInterface[]
     */
    protected function getStockUpdateHandlerPlugins(Container $container): array
    {
        return [
            new AvailabilityHandlerPlugin(),
            new ProductBundleAvailabilityHandlerPlugin(),
            new LeadProductStockUpdateHandlerPlugin(),
        ];
    }
}
