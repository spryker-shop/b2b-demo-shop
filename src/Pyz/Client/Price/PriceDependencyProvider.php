<?php



declare(strict_types = 1);

namespace Pyz\Client\Price;

use Spryker\Client\PersistentCart\Plugin\UpdatePersistentCartPriceModePlugin;
use Spryker\Client\Price\PriceDependencyProvider as SprykerPriceDependencyProvider;

class PriceDependencyProvider extends SprykerPriceDependencyProvider
{
    /**
     * @return array<\Spryker\Client\PriceExtension\Dependency\Plugin\PriceModePostUpdatePluginInterface>
     */
    protected function getPriceModePostUpdatePlugins(): array
    {
        return [
            new UpdatePersistentCartPriceModePlugin(),
        ];
    }
}
