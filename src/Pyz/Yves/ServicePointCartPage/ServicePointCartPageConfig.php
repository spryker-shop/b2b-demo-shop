<?php

namespace Pyz\Yves\ServicePointCartPage;

use Generated\Shared\Transfer\ItemTransfer;
use SprykerShop\Yves\ServicePointCartPage\ServicePointCartPageConfig as SprykerServicePointCartPageConfig;

class ServicePointCartPageConfig extends SprykerServicePointCartPageConfig
{
    /**
     * @var list<string>
     */
    protected const QUOTE_ITEM_FIELDS_ALLOWED_FOR_RESET = [
        ItemTransfer::SERVICE_POINT,
        ItemTransfer::SHIPMENT,
        ItemTransfer::SHIPMENT_TYPE,
    ];
}
