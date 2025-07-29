<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\ShopPermission;

use SprykerShop\Yves\ShopPermission\Plugin\Twig\PermissionTwigExtensionPlugin;
use SprykerShop\Yves\ShopPermission\ShopPermissionDependencyProvider as SprykerShopPermissionDependencyProvider;

class ShopPermissionDependencyProvider extends SprykerShopPermissionDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\ShopApplication\Plugin\AbstractTwigExtensionPlugin>
     */
    protected function getPermissionTwigExtensionPlugins(): array
    {
        return [
            new PermissionTwigExtensionPlugin(),
        ];
    }
}
