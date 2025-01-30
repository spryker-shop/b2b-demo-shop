<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\OauthPermission;

use Generated\Shared\Transfer\CustomerIdentifierTransfer;
use Spryker\Zed\OauthPermission\OauthPermissionConfig as SprykerOauthPermissionConfig;

class OauthPermissionConfig extends SprykerOauthPermissionConfig
{
    /**
     * @return array<string>
     */
    public function getOauthUserIdentifierFilterKeys(): array
    {
        return [
            CustomerIdentifierTransfer::PERMISSIONS,
        ];
    }
}
