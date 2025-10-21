<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Client\SelfServicePortal;

use SprykerFeature\Client\SelfServicePortal\SelfServicePortalConfig as SprykerSelfServicePortalConfig;

class SelfServicePortalConfig extends SprykerSelfServicePortalConfig
{
    protected const SHIPMENT_TYPE_IN_CENTER_SERVICE = 'in-center-service';

    /**
     * @return list<string>
     */
    public function getProductOfferServiceAvailabilityShipmentTypeKeys(): array
    {
        return [
            self::SHIPMENT_TYPE_IN_CENTER_SERVICE,
        ];
    }
}
