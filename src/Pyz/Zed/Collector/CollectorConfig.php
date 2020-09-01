<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Collector;

use Spryker\Zed\Collector\CollectorConfig as SprykerCollectorConfig;

class CollectorConfig extends SprykerCollectorConfig
{
    /**
     * @return bool
     */
    public function isCollectorEnabled(): bool
    {
        return false;
    }
}
