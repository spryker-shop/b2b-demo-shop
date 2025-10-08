<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\OauthCompanyUser;

use Spryker\Zed\OauthCompanyUser\OauthCompanyUserDependencyProvider as SprykerOauthCompanyUserDependencyProvider;
use Spryker\Zed\OauthPermission\Communication\Plugin\OauthCompanyUser\StoredPermissionOauthCompanyUserIdentifierExpanderPlugin;

class OauthCompanyUserDependencyProvider extends SprykerOauthCompanyUserDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\OauthCompanyUserExtension\Dependency\Plugin\OauthCompanyUserIdentifierExpanderPluginInterface>
     */
    protected function getOauthCompanyUserIdentifierExpanderPlugins(): array
    {
        return [
            new StoredPermissionOauthCompanyUserIdentifierExpanderPlugin(),
        ];
    }
}
