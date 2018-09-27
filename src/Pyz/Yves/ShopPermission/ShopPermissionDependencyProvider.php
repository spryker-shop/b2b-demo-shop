<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ShopPermission;

use SprykerShop\Yves\ShopPermission\Plugin\Twig\PermissionTwigFunctionPlugin;
use SprykerShop\Yves\ShopPermission\ShopPermissionDependencyProvider as SprykerShopPermissionDependencyProvider;

class ShopPermissionDependencyProvider extends SprykerShopPermissionDependencyProvider
{
    /**
     * @return \Spryker\Yves\Twig\Plugin\TwigFunctionPluginInterface[]
     */
    protected function getPermissionTwigFunctionPlugins()
    {
        return [
            new PermissionTwigFunctionPlugin(),
        ];
    }
}
