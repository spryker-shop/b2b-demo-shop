<?php



declare(strict_types = 1);

namespace Pyz\Client\Currency;

use Spryker\Client\CartCurrencyConnector\CurrencyChange\CartUpdateCurrencyOnCurrencyChangePlugin;
use Spryker\Client\Currency\CurrencyDependencyProvider as SprykerCurrencyDependencyProvider;

class CurrencyDependencyProvider extends SprykerCurrencyDependencyProvider
{
    /**
     * @return array<\Spryker\Client\CurrencyExtension\Dependency\CurrencyPostChangePluginInterface>
     */
    protected function getCurrencyPostChangePlugins(): array
    {
        return [
            new CartUpdateCurrencyOnCurrencyChangePlugin(),
        ];
    }
}
