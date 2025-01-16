<?php



declare(strict_types = 1);

namespace Pyz\Zed\Shipment;

use Spryker\Zed\Shipment\ShipmentConfig as SprykerShipmentConfig;

class ShipmentConfig extends SprykerShipmentConfig
{
    /**
     * @return bool
     */
    public function shouldExecuteQuotePostRecalculationPlugins(): bool
    {
        return false;
    }
}
