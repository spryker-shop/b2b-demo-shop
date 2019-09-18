<?php
/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Shared\Shipment;

use Spryker\Shared\Shipment\ShipmentConfig as SprykerShipmentConfig;

class ShipmentConfig extends SprykerShipmentConfig
{
    /**
     * @return bool
     */
    public function isMultiShipmentSelectionEnabled(): bool
    {
        return true;
    }
}
