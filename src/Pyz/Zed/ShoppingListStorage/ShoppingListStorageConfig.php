<?php



declare(strict_types = 1);

namespace Pyz\Zed\ShoppingListStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\ShoppingListStorage\ShoppingListStorageConfig as SprykerShoppingListStorageConfig;

class ShoppingListStorageConfig extends SprykerShoppingListStorageConfig
{
    /**
     * @return string|null
     */
    public function getShoppingListSynchronizationPoolName(): ?string
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
