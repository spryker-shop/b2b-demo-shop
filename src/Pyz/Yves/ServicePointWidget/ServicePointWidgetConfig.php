<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\ServicePointWidget;

use Generated\Shared\Transfer\ItemTransfer;
use SprykerShop\Yves\ServicePointWidget\ServicePointWidgetConfig as SprykerServicePointWidgetConfig;

class ServicePointWidgetConfig extends SprykerServicePointWidgetConfig
{
    /**
     * @var string
     */
    protected const SHIPMENT_TYPE_ON_SITE_SERVICE = 'on-site-service';

    public function getNotApplicableServicePointAddressStepFormItemPropertiesForHydration(): array
    {
        return [
            ItemTransfer::BUNDLE_ITEM_IDENTIFIER,
            ItemTransfer::RELATED_BUNDLE_ITEM_IDENTIFIER,
        ];
    }

    /**
     * @return list<string>
     */
    public function getDeliveryShipmentTypeKeys(): array
    {
        return [
            static::SHIPMENT_TYPE_DELIVERY,
            static::SHIPMENT_TYPE_ON_SITE_SERVICE,
        ];
    }
}
