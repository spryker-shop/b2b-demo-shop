<?php



declare(strict_types = 1);

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
