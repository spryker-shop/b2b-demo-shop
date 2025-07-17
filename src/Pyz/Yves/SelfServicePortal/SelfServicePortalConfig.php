<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\SelfServicePortal;

use SprykerFeature\Yves\SelfServicePortal\SelfServicePortalConfig as SprykerSelfServicePortalConfig;

/**
 * @method \SprykerFeature\Shared\SelfServicePortal\SelfServicePortalConfig getSharedConfig()
 */
class SelfServicePortalConfig extends SprykerSelfServicePortalConfig
{
    /**
     * @api
     *
     * @var string
     */
    protected const SHIPMENT_TYPE_IN_CENTER_SERVICE = 'in-center-service';

    /**
     * @api
     *
     * @uses \Spryker\Shared\ShipmentType\ShipmentTypeConfig::SHIPMENT_TYPE_DELIVERY
     *
     * @var string
     */
    public const SHIPMENT_TYPE_DELIVERY = 'delivery';

    /**
     * @api
     *
     * @var string
     */
    public const SHIPMENT_TYPE_ON_SITE_SERVICE = 'on-site-service';

    /**
     * Specification:
     * - Returns the shipment type keys in the order they should be displayed.
     * - Shipment types not in this list will be displayed after the ones in this list.
     *
     * @api
     *
     * @return list<string>
     */
    public function getShipmentTypeSortOrder(): array
    {
        return [
            static::SHIPMENT_TYPE_DELIVERY,
            static::SHIPMENT_TYPE_ON_SITE_SERVICE,
            static::SHIPMENT_TYPE_IN_CENTER_SERVICE,
        ];
    }
}
