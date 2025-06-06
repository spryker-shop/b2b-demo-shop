<?php

namespace Pyz\Service\Shipment;

use Generated\Shared\Transfer\ShipmentTransfer;
use Spryker\Service\Shipment\ShipmentConfig as SprykerShipmentConfig;

class ShipmentConfig extends SprykerShipmentConfig
{
    /**
     * @return array<string>
     */
    public function getShipmentHashFields(): array
    {
        return array_merge(
            parent::getShipmentHashFields(),
            [
                ShipmentTransfer::MERCHANT_REFERENCE,
                ShipmentTransfer::SHIPMENT_TYPE_UUID,

            ]
        );
    }
}
