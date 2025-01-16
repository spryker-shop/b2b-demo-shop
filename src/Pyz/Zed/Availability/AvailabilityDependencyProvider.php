<?php



declare(strict_types = 1);

namespace Pyz\Zed\Availability;

use Spryker\Zed\Availability\AvailabilityDependencyProvider as SprykerAvailabilityDependencyProvider;
use Spryker\Zed\Availability\Communication\Plugin\Cart\ProductConcreteBatchAvailabilityStrategyPlugin;
use Spryker\Zed\ProductConfigurationCart\Communication\Plugin\Availability\ProductConfigurationCartItemQuantityCounterStrategyPlugin;
use SprykerShop\Zed\DateTimeConfiguratorPageExample\Communication\Plugin\Availability\ExampleDateTimeConfiguratorAvailabilityStrategyPlugin;

class AvailabilityDependencyProvider extends SprykerAvailabilityDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\AvailabilityExtension\Dependency\Plugin\BatchAvailabilityStrategyPluginInterface>
     */
    protected function getBatchAvailabilityStrategyPlugins(): array
    {
        return [
            /*
             * ProductConcreteBatchAvailabilityStrategyPlugin needs to be after all other implementations.
             */
            new ProductConcreteBatchAvailabilityStrategyPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\AvailabilityExtension\Dependency\Plugin\AvailabilityStrategyPluginInterface>
     */
    protected function getAvailabilityStrategyPlugins(): array
    {
        return [
            new ExampleDateTimeConfiguratorAvailabilityStrategyPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\AvailabilityExtension\Dependency\Plugin\CartItemQuantityCounterStrategyPluginInterface>
     */
    protected function getCartItemQuantityCounterStrategyPlugins(): array
    {
        return [
            new ProductConfigurationCartItemQuantityCounterStrategyPlugin(),
        ];
    }
}
