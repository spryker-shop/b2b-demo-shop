<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\CategoryStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Shared\Publisher\PublisherConfig;
use Spryker\Zed\CategoryStorage\CategoryStorageConfig as SprykerCategoryStorageConfig;

class CategoryStorageConfig extends SprykerCategoryStorageConfig
{
    public function getCategoryTreeSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }

    public function getCategoryNodeSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }

    public function getCategoryNodeEventQueueName(): ?string
    {
        return PublisherConfig::PUBLISH_QUEUE;
    }

    public function getCategoryTreeEventQueueName(): ?string
    {
        return PublisherConfig::PUBLISH_QUEUE;
    }
}
