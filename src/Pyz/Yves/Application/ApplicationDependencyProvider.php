<?php



declare(strict_types = 1);

namespace Pyz\Yves\Application;

use Spryker\Yves\Application\ApplicationDependencyProvider as SprykerApplicationDependencyProvider;
use SprykerShop\Yves\DateTimeConfiguratorPageExample\Plugin\Application\ConfiguratorSecurityHeaderExpanderPlugin;

class ApplicationDependencyProvider extends SprykerApplicationDependencyProvider
{
    /**
     * @return array<\Spryker\Yves\ApplicationExtension\Dependency\Plugin\SecurityHeaderExpanderPluginInterface>
     */
    protected function getSecurityHeaderExpanderPlugins(): array
    {
        return [
            new ConfiguratorSecurityHeaderExpanderPlugin(),
        ];
    }
}
