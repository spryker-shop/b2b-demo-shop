<?php



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
