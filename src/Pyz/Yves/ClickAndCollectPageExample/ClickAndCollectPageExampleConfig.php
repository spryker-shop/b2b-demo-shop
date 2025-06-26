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
    /**
     * @var string
     */
    protected const SHIPMENT_TYPE_IN_CENTER_SERVICE = 'in-center-service';

    /**
     * @var list<string>
     */
    protected const CLICK_AND_COLLECT_SHIPMENT_TYPES = [
        self::SHIPMENT_TYPE_IN_CENTER_SERVICE,
        self::SHIPMENT_TYPE_DELIVERY,
        self::SHIPMENT_TYPE_PICKUP,
    ];

    /**
     * @var list<string>
     */
    protected const DEFAULT_PICKABLE_SERVICE_TYPES = [
        self::SERVICE_TYPE_PICKUP,
        self::SHIPMENT_TYPE_IN_CENTER_SERVICE,
    ];
}
