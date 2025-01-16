<?php



declare(strict_types = 1);

namespace Pyz\Zed\CmsBlockStorage;

use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\CmsBlockStorage\CmsBlockStorageConfig as SprykerCmsBlockStorageConfig;

class CmsBlockStorageConfig extends SprykerCmsBlockStorageConfig
{
    /**
     * @return string|null
     */
    public function getEventQueueName(): ?string
    {
        return PublisherConfig::PUBLISH_QUEUE;
    }
}
