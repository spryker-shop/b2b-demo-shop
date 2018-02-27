<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Permission;

use SprykerShop\Shared\CartPage\Plugin\AddCartItemPermissionPlugin;
use SprykerShop\Shared\CartPage\Plugin\ChangeCartItemPermissionPlugin;
use SprykerShop\Shared\CartPage\Plugin\RemoveCartItemPermissionPlugin;
use Spryker\Client\CompanyRole\Plugin\PermissionStoragePlugin;
use Spryker\Client\CompanyUser\Plugin\AddCompanyUserPermissionPlugin;
use Spryker\Client\Permission\Dependency\Plugin\PermissionStoragePluginInterface;
use Spryker\Client\Permission\PermissionDependencyProvider as SprykerPermissionDependencyProvider;
use Spryker\Client\Permission\Plugin\PermissionPluginInterface;

class PermissionDependencyProvider extends SprykerPermissionDependencyProvider
{
    /**
     * @return PermissionStoragePluginInterface
     */
    protected function getPermissionStoragePlugin(): PermissionStoragePluginInterface
    {
        return new PermissionStoragePlugin();
    }

    /**
     * @return PermissionPluginInterface[]
     */
    protected function getPermissionPlugins(): array
    {
        return [
            new AddCompanyUserPermissionPlugin(),
            new AddCartItemPermissionPlugin(),
            new RemoveCartItemPermissionPlugin(),
            new ChangeCartItemPermissionPlugin()
        ];
    }
}
