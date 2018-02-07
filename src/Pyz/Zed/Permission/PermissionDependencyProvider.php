<?php

namespace Pyz\Zed\Permission;

use Spryker\Zed\CompanyRole\Communication\Plugin\PermissionStoragePlugin;
use Spryker\Zed\Permission\Communication\Plugin\PermissionStoragePluginInterface;

class PermissionDependencyProvider extends \Spryker\Zed\Permission\PermissionDependencyProvider
{
    /**
     * @return PermissionStoragePluginInterface
     */
    protected function getPermissionStoragePlugin(): PermissionStoragePluginInterface
    {
        return new PermissionStoragePlugin();
    }
}