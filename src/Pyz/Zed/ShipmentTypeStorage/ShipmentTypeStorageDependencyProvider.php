<?php

namespace Pyz\Zed\ShipmentTypeStorage;

use Spryker\Zed\ShipmentTypeServicePointStorage\Communication\Plugin\ShipmentTypeStorage\ServiceTypeShipmentTypeStorageExpanderPlugin;
use Spryker\Zed\ShipmentTypeStorage\ShipmentTypeStorageDependencyProvider as SprykerShipmentTypeStorageDependencyProvider;

class ShipmentTypeStorageDependencyProvider extends SprykerShipmentTypeStorageDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\ShipmentTypeStorageExtension\Dependency\Plugin\ShipmentTypeStorageExpanderPluginInterface>
     */
    protected function getShipmentTypeStorageExpanderPlugins(): array
    {
        return [
            new ServiceTypeShipmentTypeStorageExpanderPlugin(),
        ];
    }
}
