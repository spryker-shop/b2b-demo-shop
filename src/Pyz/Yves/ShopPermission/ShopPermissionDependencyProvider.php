<?php

namespace Pyz\Yves\ShopPermission;

use SprykerShop\Yves\ShopPermission\Plugin\Twig\PermissionTwigFunctionPlugin;

class ShopPermissionDependencyProvider extends \SprykerShop\Yves\ShopPermission\ShopPermissionDependencyProvider
{
    /**
     * @return \Spryker\Yves\Twig\Plugin\TwigFunctionPluginInterface[]
     */
    protected function getPermissionTwigFunctionPlugins()
    {
        return [
            new PermissionTwigFunctionPlugin()
        ];
    }
}