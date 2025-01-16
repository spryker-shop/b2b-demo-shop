<?php



declare(strict_types = 1);

namespace Pyz\Zed\AvailabilityStorage;

use Spryker\Shared\AvailabilityStorage\AvailabilityStorageConfig as SprykerSharedAvailabilityStorageConfig;
use Spryker\Zed\AvailabilityStorage\AvailabilityStorageConfig as SprykerAvailabilityStorageConfig;

class AvailabilityStorageConfig extends SprykerAvailabilityStorageConfig
{
    /**
     * @return string|null
     */
    public function getEventQueueName(): ?string
    {
        return SprykerSharedAvailabilityStorageConfig::PUBLISH_AVAILABILITY;
    }
}
