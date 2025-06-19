<?php

namespace Pyz\Zed\ShipmentTypeStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\ShipmentTypeStorage\ShipmentTypeStorageConfig as SprykerShipmentTypeStorageConfig;

class ShipmentTypeStorageConfig extends SprykerShipmentTypeStorageConfig
{
    /**
     * @return string|null
     */
    public function getShipmentTypeStorageSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
