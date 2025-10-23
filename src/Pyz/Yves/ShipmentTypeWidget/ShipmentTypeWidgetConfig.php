<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\ShipmentTypeWidget;

use Generated\Shared\Transfer\ItemTransfer;
use SprykerShop\Yves\ShipmentTypeWidget\ShipmentTypeWidgetConfig as SprykerShipmentTypeWidgetConfig;

class ShipmentTypeWidgetConfig extends SprykerShipmentTypeWidgetConfig
{
    /**
     * @return list<string>
     */
    public function getNotApplicableShipmentTypeAddressStepFormItemPropertiesForHydration(): array
    {
        return [
            ItemTransfer::BUNDLE_ITEM_IDENTIFIER,
            ItemTransfer::RELATED_BUNDLE_ITEM_IDENTIFIER,
        ];
    }

    /**
     * @return array<int, string>
     */
    public function getDeliveryShipmentTypes(): array
    {
        return [
            static::SHIPMENT_TYPE_DELIVERY,
        ];
    }
}
