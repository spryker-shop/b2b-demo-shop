<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Permission;

use Spryker\Client\Permission\PermissionClient as SprykerPermissionClient;

/**
 * @project Only needed in non-split, not in a split
 */
class PermissionClient extends SprykerPermissionClient
{
    /**
     * @param string $permissionKey
     * @param null $context
     *
     * @return bool
     */
    public function can($permissionKey, $context = null): bool
    {
        return true;
    }
}
