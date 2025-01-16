<?php



declare(strict_types = 1);

namespace Pyz\Zed\Authorization;

use Spryker\Zed\ApiKeyAuthorizationConnector\Communication\Plugin\Authorization\ApiKeyAuthorizationStrategyPlugin;
use Spryker\Zed\Authorization\AuthorizationDependencyProvider as SprykerAuthorizationDependencyProvider;
use Spryker\Zed\GlueBackendApiApplicationAuthorizationConnector\Communication\Plugin\Authorization\ProtectedPathAuthorizationStrategyPlugin;
use Spryker\Zed\OauthUserConnector\Communication\Plugin\Authorization\OauthUserScopeAuthorizationStrategyPlugin;

class AuthorizationDependencyProvider extends SprykerAuthorizationDependencyProvider
{
    /**
     * @return array<\Spryker\Shared\AuthorizationExtension\Dependency\Plugin\AuthorizationStrategyPluginInterface>
     */
    protected function getAuthorizationStrategyPlugins(): array
    {
        return [
            new ProtectedPathAuthorizationStrategyPlugin(),
            new ApiKeyAuthorizationStrategyPlugin(),
            new OauthUserScopeAuthorizationStrategyPlugin(),
        ];
    }
}
