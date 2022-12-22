<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\QuickOrder;

use Spryker\Client\PriceProductStorage\Plugin\QuickOrder\ProductPriceItemValidatorPlugin;
use Spryker\Client\ProductDiscontinuedStorage\Plugin\QuickOrder\ProductDiscontinuedItemValidatorPlugin;
use Spryker\Client\ProductMeasurementUnitStorage\Plugin\QuickOrder\ProductConcreteTransferBaseMeasurementUnitExpanderPlugin;
use Spryker\Client\ProductQuantityStorage\Plugin\QuickOrder\ProductQuantityItemValidatorPlugin;
use Spryker\Client\QuickOrder\QuickOrderDependencyProvider as SprykerQuickOrderDependencyProvider;

class QuickOrderDependencyProvider extends SprykerQuickOrderDependencyProvider
{
    /**
     * @return array<\Spryker\Client\QuickOrderExtension\Dependency\Plugin\ProductConcreteExpanderPluginInterface>
     */
    protected function getProductConcreteExpanderPlugins(): array
    {
        return [
            new ProductConcreteTransferBaseMeasurementUnitExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Client\QuickOrderExtension\Dependency\Plugin\ItemValidatorPluginInterface>
     */
    protected function getQuickOrderBuildItemValidatorPlugins(): array
    {
        return [
            new ProductDiscontinuedItemValidatorPlugin(),
            new ProductPriceItemValidatorPlugin(),
            new ProductQuantityItemValidatorPlugin(),
        ];
    }
}
