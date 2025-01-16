<?php



declare(strict_types = 1);

namespace Pyz\Zed\GlossaryStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\GlossaryStorage\GlossaryStorageConfig as SprykerGlossaryStorageConfig;

class GlossaryStorageConfig extends SprykerGlossaryStorageConfig
{
    /**
     * @return string|null
     */
    public function getGlossarySynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
