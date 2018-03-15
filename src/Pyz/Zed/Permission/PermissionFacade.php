<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Permission;

use Spryker\Zed\Permission\Business\PermissionFacade as SprykerPermissionFacade;

/**
 * @project Only needed in non-split, not in a split
 */
class PermissionFacade extends SprykerPermissionFacade
{
    /**
     * @param string $permissionKey
     * @param int|string $identifier
     * @param null $context
     *
     * @return bool
     */
    public function can($permissionKey, $identifier, $context = null): bool
    {
        return true;
    }
}
