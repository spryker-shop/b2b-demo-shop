<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

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
