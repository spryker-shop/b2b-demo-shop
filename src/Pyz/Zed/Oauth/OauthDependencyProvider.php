<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Oauth;

use Spryker\Zed\Oauth\OauthDependencyProvider as SprykerOauthDependencyProvider;

class OauthDependencyProvider extends SprykerOauthDependencyProvider
{
    /**
     * @return \Spryker\Zed\OauthExtension\Dependency\Plugin\UserProviderPluginInterface[]
     */
    protected function getUserProviderPlugins(): array
    {
        return [];
    }

    /**
     * @return \Spryker\Zed\OauthExtension\Dependency\Plugin\ScopeProviderPluginInterface[]
     */
    protected function getScopeProviderPlugins(): array
    {
        return [];
    }
}
