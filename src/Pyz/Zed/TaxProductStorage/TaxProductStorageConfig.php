<?php



declare(strict_types = 1);

namespace Pyz\Zed\TaxProductStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\TaxProductStorage\TaxProductStorageConfig as SprykerTaxProductStorageConfig;

class TaxProductStorageConfig extends SprykerTaxProductStorageConfig
{
    /**
     * @return string|null
     */
    public function getTaxProductSynchronizationPoolName(): ?string
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
