<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\Synchronization;

use Spryker\Zed\Synchronization\SynchronizationConfig as SprykerSynchronizationConfig;

class SynchronizationConfig extends SprykerSynchronizationConfig
{
    /**
     * @var string
     */
    public const DEFAULT_SYNCHRONIZATION_POOL_NAME = 'synchronizationPool';

    /**
     * @return bool
     */
    public function isRepositorySyncExportPropelInstancePoolingDisabled(): bool
    {
        return true;
    }
}
