<?php



declare(strict_types = 1);

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
