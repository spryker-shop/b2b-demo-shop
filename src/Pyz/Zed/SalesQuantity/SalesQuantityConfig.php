<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\SalesQuantity;

use Spryker\Zed\SalesQuantity\SalesQuantityConfig as SprykerSalesQuantityConfig;

class SalesQuantityConfig extends SprykerSalesQuantityConfig
{
    /**
     * @see \Spryker\Zed\SalesQuantity\SalesQuantityConfig::ITEM_NONSPLIT_QUANTITY_THRESHOLD
     *
     * @var int
     */
    protected const ITEM_NONSPLIT_QUANTITY_THRESHOLD = 10;
}
