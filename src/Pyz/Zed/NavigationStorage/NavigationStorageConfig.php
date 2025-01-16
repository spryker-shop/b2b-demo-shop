<?php



declare(strict_types = 1);

namespace Pyz\Zed\NavigationStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\NavigationStorage\NavigationStorageConfig as SprykerNavigationStorageConfig;

class NavigationStorageConfig extends SprykerNavigationStorageConfig
{
    /**
     * @return string|null
     */
    public function getNavigationSynchronizationPoolName(): ?string
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
