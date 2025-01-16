<?php



declare(strict_types = 1);

namespace Pyz\Zed\Router;

use Spryker\Zed\Router\RouterConfig as SprykerRouterConfig;

class RouterConfig extends SprykerRouterConfig
{
    /**
     * @return array<string>
     */
    public function getControllerDirectories(): array
    {
        $controllerDirectories = parent::getControllerDirectories();

        $controllerDirectories[] = sprintf('%s/spryker-sdk/*/src/*/Zed/*/Communication/Controller/', APPLICATION_VENDOR_DIR);
        $controllerDirectories[] = sprintf('%s/spryker-eco/*/src/*/Zed/*/Communication/Controller/', APPLICATION_VENDOR_DIR);

        return array_filter($controllerDirectories, 'glob');
    }

    /**
     * @return bool
     */
    public function isRoutingCacheEnabled(): bool
    {
        return true;
    }
}
