<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

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

            ],
        );
    }
}
