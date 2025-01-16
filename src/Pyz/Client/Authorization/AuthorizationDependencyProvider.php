<?php



declare(strict_types = 1);

namespace Pyz\Client\Authorization;

use Spryker\Client\Authorization\AuthorizationDependencyProvider as SprykerAuthorizationDependencyProvider;
use Spryker\Client\Customer\Plugin\Authorization\CustomerReferenceMatchingEntityIdAuthorizationStrategyPlugin;
use Spryker\Client\GlueStorefrontApiApplicationAuthorizationConnector\Plugin\Authorization\ProtectedPathAuthorizationStrategyPlugin;

class AuthorizationDependencyProvider extends SprykerAuthorizationDependencyProvider
{
    /**
     * @return array<\Spryker\Shared\AuthorizationExtension\Dependency\Plugin\AuthorizationStrategyPluginInterface>
     */
    protected function getAuthorizationStrategyPlugins(): array
    {
        return [
            new CustomerReferenceMatchingEntityIdAuthorizationStrategyPlugin(),
            new ProtectedPathAuthorizationStrategyPlugin(),
        ];
    }
}
