<?php



declare(strict_types = 1);

namespace Pyz\Glue\Router;

use Spryker\Glue\GlueApplication\Plugin\Rest\GlueRouterPlugin;
use Spryker\Glue\Router\RouterDependencyProvider as SprykerRouterDependencyProvider;

class RouterDependencyProvider extends SprykerRouterDependencyProvider
{
    /**
     * @return array<\Spryker\Glue\RouterExtension\Dependency\Plugin\RouterPluginInterface|\Spryker\Glue\Kernel\AbstractPlugin>
     */
    protected function getRouterPlugins(): array
    {
        return [
            new GlueRouterPlugin(),
        ];
    }
}
