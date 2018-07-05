<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\GlossaryStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\GlossaryStorage\GlossaryStorageConfig as AbstractGlossaryStorageConfig;

class GlossaryStorageConfig extends AbstractGlossaryStorageConfig
{
    /**
     * @return bool
     */
    public function isSendingToQueue(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getGlossarySynchronizationPoolName(): string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
