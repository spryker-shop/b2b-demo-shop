<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\PersistentCartShare;

use Spryker\Client\PersistentCartShare\PersistentCartShareDependencyProvider as SprykerPersistentCartShareDependencyProvider;
use Spryker\Client\PersistentCartShare\Plugin\PersistentCartShare\PreviewCartShareOptionPlugin;
use Spryker\Client\SharedCart\Plugin\PersistentCartShare\FullAccessCartShareOptionPlugin;
use Spryker\Client\SharedCart\Plugin\PersistentCartShare\ReadOnlyCartShareOptionPlugin;

class PersistentCartShareDependencyProvider extends SprykerPersistentCartShareDependencyProvider
{
    /**
     * @return array<\Spryker\Client\PersistentCartShareExtension\Dependency\Plugin\CartShareOptionPluginInterface>
     */
    protected function getCartShareOptionPlugins(): array
    {
        return [
            new PreviewCartShareOptionPlugin(),
            new ReadOnlyCartShareOptionPlugin(),
            new FullAccessCartShareOptionPlugin(),
        ];
    }
}
