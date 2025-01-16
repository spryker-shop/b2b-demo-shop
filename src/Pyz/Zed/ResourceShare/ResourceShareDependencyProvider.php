<?php



declare(strict_types = 1);

namespace Pyz\Zed\ResourceShare;

use Spryker\Zed\ResourceShare\ResourceShareDependencyProvider as SprykerResourceShareDependencyProvider;
use Spryker\Zed\SharedCart\Communication\Plugin\ResourceShare\ShareCartByResourceShareZedActivatorStrategyPlugin;

class ResourceShareDependencyProvider extends SprykerResourceShareDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\ResourceShareExtension\Dependency\Plugin\ResourceShareZedActivatorStrategyPluginInterface>
     */
    protected function getResourceShareActivatorStrategyPlugins(): array
    {
        return [
            new ShareCartByResourceShareZedActivatorStrategyPlugin(),
        ];
    }
}
