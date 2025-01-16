<?php



declare(strict_types = 1);

namespace Pyz\Glue\AuthRestApi;

use Spryker\Glue\AgentAuthRestApi\Plugin\AuthRestApi\AgentRestUserMapperPlugin;
use Spryker\Glue\AuthRestApi\AuthRestApiDependencyProvider as SprykerAuthRestApiDependencyProvider;
use Spryker\Glue\CompanyUserAuthRestApi\Plugin\AuthRestApi\CompanyUserRestUserMapperPlugin;

/**
 * @method \Spryker\Glue\AuthRestApi\AuthRestApiConfig getConfig()
 */
class AuthRestApiDependencyProvider extends SprykerAuthRestApiDependencyProvider
{
    /**
     * @return array<\Spryker\Glue\AuthRestApiExtension\Dependency\Plugin\RestUserMapperPluginInterface>
     */
    protected function getRestUserExpanderPlugins(): array
    {
        return [
            new CompanyUserRestUserMapperPlugin(),
            new AgentRestUserMapperPlugin(),
        ];
    }
}
