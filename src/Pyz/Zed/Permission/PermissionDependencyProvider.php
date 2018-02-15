<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Permission;

use Spryker\Zed\CompanyRole\Communication\Plugin\PermissionStoragePlugin;
use Spryker\Zed\Permission\Communication\Plugin\PermissionStoragePluginInterface;
use Spryker\Zed\Permission\PermissionDependencyProvider as SprykerPermissionDependencyProvider;

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
