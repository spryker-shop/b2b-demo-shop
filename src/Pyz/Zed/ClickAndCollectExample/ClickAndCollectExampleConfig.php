<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ClickAndCollectExample;

use Spryker\Zed\ClickAndCollectExample\ClickAndCollectExampleConfig as SprykerClickAndCollectExampleConfig;

class ClickAndCollectExampleConfig extends SprykerClickAndCollectExampleConfig
{
    /**
     * @var string
     */
    protected const SHIPMENT_TYPE_IN_CENTER_SERVICE = 'in-center-service';

    /**
     * @api
     *
     * @return string
     */
    public function getPickupShipmentTypeKey(): string
    {
        return static::SHIPMENT_TYPE_IN_CENTER_SERVICE;
    }
}
