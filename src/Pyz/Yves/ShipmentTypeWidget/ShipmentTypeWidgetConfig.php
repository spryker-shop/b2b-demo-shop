<?php

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
}
