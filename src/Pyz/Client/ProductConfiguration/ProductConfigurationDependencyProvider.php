<?php



declare(strict_types = 1);

namespace Pyz\Client\ProductConfiguration;

use Spryker\Client\ProductConfiguration\Plugin\PriceProductVolumeProductConfigurationPriceExtractorPlugin;
use Spryker\Client\ProductConfiguration\ProductConfigurationDependencyProvider as SprykerProductConfigurationDependencyProvider;
use SprykerShop\Client\DateTimeConfiguratorPageExample\Plugin\ProductConfiguration\ExampleDateTimeProductConfiguratorRequestExpanderPlugin;

/**
 * @method \Spryker\Client\ProductConfiguration\ProductConfigurationConfig getConfig()
 */
class ProductConfigurationDependencyProvider extends SprykerProductConfigurationDependencyProvider
{
    /**
     * @return array<\Spryker\Client\ProductConfigurationExtension\Dependency\Plugin\ProductConfiguratorRequestExpanderPluginInterface>
     */
    protected function getProductConfigurationRequestExpanderPlugins(): array
    {
        return [
            new ExampleDateTimeProductConfiguratorRequestExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Client\ProductConfigurationExtension\Dependency\Plugin\ProductConfigurationPriceExtractorPluginInterface>
     */
    protected function getProductConfigurationPriceExtractorPlugins(): array
    {
        return [
            new PriceProductVolumeProductConfigurationPriceExtractorPlugin(),
        ];
    }
}
