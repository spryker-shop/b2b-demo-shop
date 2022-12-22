<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\OauthCustomerConnector;

use Spryker\Zed\CompanyUsersRestApi\Communication\Plugin\OauthCustomerConnector\CompanyUserOauthCustomerIdentifierExpanderPlugin;
use Spryker\Zed\OauthCustomerConnector\OauthCustomerConnectorDependencyProvider as SprykerOauthCustomerConnectorDependencyProvider;
use Spryker\Zed\OauthPermission\Communication\Plugin\OauthCustomerConnector\PermissionOauthCustomerIdentifierExpanderPlugin;

/**
 * @method \Spryker\Zed\OauthCustomerConnector\OauthCustomerConnectorConfig getConfig()
 */
class OauthCustomerConnectorDependencyProvider extends SprykerOauthCustomerConnectorDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\OauthCustomerConnectorExtension\Dependency\Plugin\OauthCustomerIdentifierExpanderPluginInterface>
     */
    protected function getOauthCustomerIdentifierExpanderPlugins(): array
    {
        return [
            new CompanyUserOauthCustomerIdentifierExpanderPlugin(),
            new PermissionOauthCustomerIdentifierExpanderPlugin(),
        ];
    }
}
