<?php



declare(strict_types = 1);

namespace Pyz\Zed\CustomerAccessStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\CustomerAccessStorage\CustomerAccessStorageConfig as SprykerCustomerAccessStorageConfig;

class CustomerAccessStorageConfig extends SprykerCustomerAccessStorageConfig
{
    /**
     * @return string|null
     */
    public function getSynchronizationPoolName(): ?string
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
