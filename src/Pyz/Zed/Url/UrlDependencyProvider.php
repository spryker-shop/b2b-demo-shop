<?php



declare(strict_types = 1);

namespace Pyz\Zed\Url;

use Spryker\Zed\Navigation\Communication\Plugin\DetachNavigationUrlAfterUrlDeletePlugin;
use Spryker\Zed\Url\UrlDependencyProvider as SprykerUrlDependencyProvider;

class UrlDependencyProvider extends SprykerUrlDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\Url\Dependency\Plugin\UrlDeletePluginInterface>
     */
    protected function getUrlBeforeDeletePlugins(): array
    {
        return [
            new DetachNavigationUrlAfterUrlDeletePlugin(),
        ];
    }
}
