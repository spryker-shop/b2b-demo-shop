<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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
