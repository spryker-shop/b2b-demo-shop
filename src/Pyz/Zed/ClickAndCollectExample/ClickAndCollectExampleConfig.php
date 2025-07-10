<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ClickAndCollectExample;

use Spryker\Zed\ClickAndCollectExample\ClickAndCollectExampleConfig as SprykerClickAndCollectExampleConfig;

class ClickAndCollectExampleConfig extends SprykerClickAndCollectExampleConfig
{
    /**
     * @var string
     */
    protected const SHIPMENT_TYPE_IN_CENTER_SERVICE = 'in-center-service';

    /**
     * @var string
     */
    protected const MERCHANT_REFERENCE = 'MERSPRYKER';

    /**
     * @api
     *
     * @return string
     */
    public function getPickupShipmentTypeKey(): string
    {
        return static::SHIPMENT_TYPE_IN_CENTER_SERVICE;
    }

    /**
     * @api
     *
     * @return string
     */
    public function getMerchantReference(): string
    {
        return static::MERCHANT_REFERENCE;
    }
}
