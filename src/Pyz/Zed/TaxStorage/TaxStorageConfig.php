<?php



declare(strict_types = 1);

namespace Pyz\Zed\TaxStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\TaxStorage\TaxStorageConfig as SprykerTaxStorageConfig;

class TaxStorageConfig extends SprykerTaxStorageConfig
{
    /**
     * @return string|null
     */
    public function getTaxSynchronizationPoolName(): ?string
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
