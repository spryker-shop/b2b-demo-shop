<?php



declare(strict_types = 1);

namespace Pyz\Zed\CmsSlotStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\CmsSlotStorage\CmsSlotStorageConfig as SprykerCmsSlotStorageConfig;

class CmsSlotStorageConfig extends SprykerCmsSlotStorageConfig
{
    /**
     * @return string|null
     */
    public function getCmsSlotStorageSynchronizationPoolName(): ?string
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
