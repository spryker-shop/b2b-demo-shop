<?php



declare(strict_types = 1);

namespace Pyz\Zed\Publisher;

use Spryker\Shared\Publisher\PublisherConfig as SharedPublisherConfig;
use Spryker\Zed\Publisher\PublisherConfig as SprykerPublisherConfig;

class PublisherConfig extends SprykerPublisherConfig
{
    /**
     * @return string|null
     */
    public function getPublishQueueName(): ?string
    {
        return SharedPublisherConfig::PUBLISH_QUEUE;
    }
}
