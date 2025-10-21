<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\ClickAndCollectPageExample;

use SprykerShop\Yves\ClickAndCollectPageExample\ClickAndCollectPageExampleConfig as SprykerClickAndCollectPageExampleConfig;

class ClickAndCollectPageExampleConfig extends SprykerClickAndCollectPageExampleConfig
{
    protected const SHIPMENT_TYPE_IN_CENTER_SERVICE = 'in-center-service';

    protected const CLICK_AND_COLLECT_SHIPMENT_TYPES = [
        self::SHIPMENT_TYPE_IN_CENTER_SERVICE,
        self::SHIPMENT_TYPE_DELIVERY,
    ];

    protected const DEFAULT_PICKABLE_SERVICE_TYPES = [
        self::SHIPMENT_TYPE_IN_CENTER_SERVICE,
    ];
}
