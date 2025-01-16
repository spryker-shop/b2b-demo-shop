<?php



declare(strict_types = 1);

namespace Pyz\Zed\SynchronizationBehavior;

use Spryker\Zed\SynchronizationBehavior\SynchronizationBehaviorConfig as SprykerSynchronizationBehaviorConfig;

class SynchronizationBehaviorConfig extends SprykerSynchronizationBehaviorConfig
{
    /**
     * @return bool
     */
    public function isDirectSynchronizationEnabled(): bool
    {
        return false;
    }
}
