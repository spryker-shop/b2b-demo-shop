<?php



declare(strict_types = 1);

namespace Pyz\Zed\CmsSlotBlockStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\CmsSlotBlockStorage\CmsSlotBlockStorageConfig as SprykerCmsSlotBlockStorageConfig;

class CmsSlotBlockStorageConfig extends SprykerCmsSlotBlockStorageConfig
{
    /**
     * @return string|null
     */
    public function getCmsSlotBlockSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }

    /**
     * @return string|null
     */
    public function getEventQueueName(): ?string
    {
        return PublisherConfig::PUBLISH_QUEUE;
    }
}
