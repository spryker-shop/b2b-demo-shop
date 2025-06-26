<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Client\ShipmentTypeStorage;

use Spryker\Client\ClickAndCollectExample\Plugin\ShipmentTypeStorage\ShipmentTypeProductOfferAvailableShipmentTypeFilterPlugin;
use Spryker\Client\ShipmentTypeServicePointStorage\Plugin\ShipmentTypeStorage\ServiceTypeShipmentTypeStorageExpanderPlugin;
use Spryker\Client\ShipmentTypeStorage\ShipmentTypeStorageDependencyProvider as SprykerShipmentTypeStorageDependencyProvider;

class ShipmentTypeStorageDependencyProvider extends SprykerShipmentTypeStorageDependencyProvider
{
    /**
     * @return list<\Spryker\Client\ShipmentTypeStorageExtension\Dependency\Plugin\AvailableShipmentTypeFilterPluginInterface>
     */
    protected function getAvailableShipmentTypeFilterPlugins(): array
    {
        return [
            new ShipmentTypeProductOfferAvailableShipmentTypeFilterPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Client\ShipmentTypeStorageExtension\Dependency\Plugin\ShipmentTypeStorageExpanderPluginInterface>
     */
    protected function getShipmentTypeStorageExpanderPlugins(): array
    {
        return [
            new ServiceTypeShipmentTypeStorageExpanderPlugin(),
        ];
    }
}
