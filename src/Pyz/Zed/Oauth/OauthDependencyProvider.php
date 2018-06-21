<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */
namespace Pyz\Zed\Oauth;

use Spryker\Zed\Oauth\OauthDependencyProvider as SprykerOauthDependencyProvider;

class OauthDependencyProvider extends SprykerOauthDependencyProvider
{
    /**
     * @return \Spryker\Zed\Oauth\Dependency\Plugin\UserProviderPluginInterface[]
     */
    protected function getUserProviderPlugins(): array
    {
        return [];
    }

    /**
     * @return \Spryker\Zed\Oauth\Dependency\Plugin\ScopeProviderPluginInterface[]
     */
    protected function getScopeProviderPlugins(): array
    {
        return [];
    }
}
