<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\OauthRevoke;

use Spryker\Zed\OauthPermission\Communication\Plugin\OauthRevoke\RefreshTokenPermissionOauthUserIdentifierFilterPlugin;
use Spryker\Zed\OauthRevoke\OauthRevokeDependencyProvider as SprykerRevokeOauthDependencyProvider;

class OauthRevokeDependencyProvider extends SprykerRevokeOauthDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\OauthRevokeExtension\Dependency\Plugin\OauthUserIdentifierFilterPluginInterface>
     */
    protected function getOauthUserIdentifierFilterPlugins(): array
    {
        return [
            new RefreshTokenPermissionOauthUserIdentifierFilterPlugin(),
        ];
    }
}
