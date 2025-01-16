<?php



declare(strict_types = 1);

namespace Pyz\Zed\OauthCompanyUser;

use Spryker\Zed\OauthCompanyUser\OauthCompanyUserDependencyProvider as SprykerOauthCompanyUserDependencyProvider;
use Spryker\Zed\OauthPermission\Communication\Plugin\OauthCompanyUser\PermissionOauthCompanyUserIdentifierExpanderPlugin;

class OauthCompanyUserDependencyProvider extends SprykerOauthCompanyUserDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\OauthCompanyUserExtension\Dependency\Plugin\OauthCompanyUserIdentifierExpanderPluginInterface>
     */
    protected function getOauthCompanyUserIdentifierExpanderPlugins(): array
    {
        return [
            new PermissionOauthCompanyUserIdentifierExpanderPlugin(),
        ];
    }
}
