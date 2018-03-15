<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Permission;

use Spryker\Zed\CompanyRole\Communication\Plugin\PermissionStoragePlugin;
use Spryker\Zed\Permission\PermissionDependencyProvider as SprykerPermissionDependencyProvider;

/**
 * @project Only needed in non-split, not in a split
 */
class PermissionDependencyProvider extends SprykerPermissionDependencyProvider
{
    /**
     * @return \Spryker\Zed\PermissionExtension\Dependency\Plugin\PermissionStoragePluginInterface[]
     */
    protected function getPermissionStoragePlugins(): array
    {
        return [
            new PermissionStoragePlugin(),
        ];
    }
}
