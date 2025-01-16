<?php



declare(strict_types = 1);

namespace Pyz\Client\ResourceShare;

use Spryker\Client\ResourceShare\ResourceShareDependencyProvider as SprykerResourceShareDependencyProvider;
use Spryker\Client\SharedCart\Plugin\ResourceShare\CartShareLoginRequiredResourceShareClientActivatorStrategyPlugin;
use Spryker\Client\SharedCart\Plugin\ResourceShare\SwitchDefaultCartResourceShareClientActivatorStrategyPlugin;

class ResourceShareDependencyProvider extends SprykerResourceShareDependencyProvider
{
    /**
     * @return array<\Spryker\Client\ResourceShareExtension\Dependency\Plugin\ResourceShareClientActivatorStrategyPluginInterface>
     */
    protected function getBeforeZedResourceShareActivatorStrategyPlugins(): array
    {
        return [
            new CartShareLoginRequiredResourceShareClientActivatorStrategyPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Client\ResourceShareExtension\Dependency\Plugin\ResourceShareClientActivatorStrategyPluginInterface>
     */
    protected function getAfterZedResourceShareActivatorStrategyPlugins(): array
    {
        return [
            new SwitchDefaultCartResourceShareClientActivatorStrategyPlugin(),
        ];
    }
}
