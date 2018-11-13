<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyUser\Communication\Plugin\Permission;

use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Shared\PermissionExtension\Dependency\Plugin\PermissionPluginInterface;

/**
 * @method \Pyz\Zed\CompanyUser\Business\CompanyUserFacadeInterface getFacade()
 */
class SeeCompanyMenuPermissionPlugin extends AbstractPlugin implements PermissionPluginInterface
{
    public const KEY = 'SeeCompanyMenuPermissionPlugin';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return static::KEY;
    }
}
