<?php



declare(strict_types = 1);

namespace Pyz\Glue\GlueBackendApiApplicationAuthorizationConnector;

use Spryker\Glue\ApiKeyAuthorizationConnector\Plugin\GlueBackendApiApplicationAuthorizationConnector\ApiKeyAuthorizationRequestExpanderPlugin;
use Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\GlueBackendApiApplicationAuthorizationConnectorDependencyProvider as SprykerGlueBackendApiApplicationAuthorizationConnectorDependencyProvider;
use Spryker\Glue\OauthUserConnector\Plugin\GlueBackendApiApplicationAuthorizationConnector\OauthUserScopeProtectedRouteAuthorizationConfigProviderPlugin;

/**
 * @method \Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\GlueBackendApiApplicationAuthorizationConnectorConfig getConfig()
 */
class GlueBackendApiApplicationAuthorizationConnectorDependencyProvider extends SprykerGlueBackendApiApplicationAuthorizationConnectorDependencyProvider
{
    /**
     * @return list<\Spryker\Glue\GlueBackendApiApplicationAuthorizationConnectorExtension\Dependency\Plugin\AuthorizationRequestExpanderPluginInterface>
     */
    protected function getAuthorizationRequestExpanderPlugins(): array
    {
        return [
            new ApiKeyAuthorizationRequestExpanderPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Glue\GlueBackendApiApplicationAuthorizationConnectorExtension\Dependency\Plugin\ProtectedRouteAuthorizationConfigProviderPluginInterface>
     */
    protected function getProtectedRouteAuthorizationConfigProviderPlugins(): array
    {
        return [
            new OauthUserScopeProtectedRouteAuthorizationConfigProviderPlugin(),
        ];
    }
}
