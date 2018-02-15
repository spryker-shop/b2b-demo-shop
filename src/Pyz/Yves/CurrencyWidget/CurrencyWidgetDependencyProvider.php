<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CurrencyWidget;

use SprykerShop\Yves\CurrencyWidget\CurrencyWidgetDependencyProvider as SprykerCurrencyWidgetDependencyProvider;
use SprykerShop\Yves\CurrencyWidget\Plugin\CurrencyChangeRebuildCartPlugin;

class CurrencyWidgetDependencyProvider extends SprykerCurrencyWidgetDependencyProvider
{
    /**
     * @return \Spryker\Yves\Currency\Dependency\CurrencyPostChangePluginInterface[]
     */
    protected function getCurrencyPostChangePlugins()
    {
        return [
            new CurrencyChangeRebuildCartPlugin(),
        ];
    }
}
