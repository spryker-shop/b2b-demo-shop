<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Permission;

use Spryker\Client\CompanyRole\Plugin\PermissionStoragePlugin;
use Spryker\Client\Permission\Dependency\Plugin\PermissionStoragePluginInterface;
use Spryker\Client\Permission\PermissionDependencyProvider as SprykerPermissionDependencyProvider;

class PermissionDependencyProvider extends SprykerPermissionDependencyProvider
{
    /**
     * @return PermissionStoragePluginInterface
     */
    protected function getPermissionStoragePlugin(): PermissionStoragePluginInterface
    {
        return new PermissionStoragePlugin();
    }
}
