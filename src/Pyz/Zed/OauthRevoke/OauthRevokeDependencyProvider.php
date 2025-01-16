<?php



declare(strict_types = 1);

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
