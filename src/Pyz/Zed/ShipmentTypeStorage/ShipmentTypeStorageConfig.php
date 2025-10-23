<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ShipmentTypeStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\ShipmentTypeStorage\ShipmentTypeStorageConfig as SprykerShipmentTypeStorageConfig;

class ShipmentTypeStorageConfig extends SprykerShipmentTypeStorageConfig
{
    public function getShipmentTypeStorageSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
