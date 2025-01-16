<?php



declare(strict_types = 1);

namespace Pyz\Glue\HealthCheck;

use Spryker\Glue\HealthCheck\HealthCheckDependencyProvider as SprykerHealthCheckDependencyProvider;
use Spryker\Glue\Search\Plugin\HealthCheck\SearchHealthCheckPlugin;
use Spryker\Glue\Storage\Plugin\HealthCheck\KeyValueStoreHealthCheckPlugin;
use Spryker\Glue\ZedRequest\Plugin\HealthCheck\ZedRequestHealthCheckPlugin;

class HealthCheckDependencyProvider extends SprykerHealthCheckDependencyProvider
{
    /**
     * @return array<\Spryker\Shared\HealthCheckExtension\Dependency\Plugin\HealthCheckPluginInterface>
     */
    protected function getHealthCheckPlugins(): array
    {
        return [
            new SearchHealthCheckPlugin(),
            new KeyValueStoreHealthCheckPlugin(),
            new ZedRequestHealthCheckPlugin(),
        ];
    }
}
