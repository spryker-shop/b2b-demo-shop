<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Router;

use Spryker\Zed\Router\Communication\Plugin\Router\BackendGatewayRouterPlugin;
use Spryker\Zed\Router\Communication\Plugin\Router\BackofficeRouterPlugin;
use Spryker\Zed\Router\Communication\Plugin\Router\MerchantPortalRouterPlugin;
use Spryker\Zed\Router\RouterDependencyProvider as SprykerRouterDependencyProvider;

class RouterDependencyProvider extends SprykerRouterDependencyProvider
{
    /**
     * @return \Spryker\Zed\RouterExtension\Dependency\Plugin\RouterPluginInterface[]
     */
    protected function getBackofficeRouterPlugins(): array
    {
        return [
            new BackofficeRouterPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\RouterExtension\Dependency\Plugin\RouterPluginInterface[]
     */
    protected function getBackendGatewayRouterPlugins(): array
    {
        return [
            new BackendGatewayRouterPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\RouterExtension\Dependency\Plugin\RouterPluginInterface[]
     */
    protected function getBackendApiRouterPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\Spryker\Zed\RouterExtension\Dependency\Plugin\RouterPluginInterface>
     */
    protected function getMerchantPortalRouterPlugins(): array
    {
        return [
            new MerchantPortalRouterPlugin(),
        ];
    }
}
