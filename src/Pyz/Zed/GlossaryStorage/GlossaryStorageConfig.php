<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\GlossaryStorage;

use Spryker\Zed\GlossaryStorage\GlossaryStorageConfig as AbstractGlossaryStorageConfig;

class GlossaryStorageConfig extends AbstractGlossaryStorageConfig
{
    /**
     * @return bool
     */
    public function isSendingToQueue()
    {
        return true;
    }

    /**
     * @return string|null
     */
    public function getGlossarySynchronizationPoolName()
    {
        return 'synchronizationPool';
    }
}
