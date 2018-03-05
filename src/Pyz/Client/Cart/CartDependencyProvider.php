<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Cart;

use Spryker\Client\Cart\CartDependencyProvider as SprykerCartDependencyProvider;
use Spryker\Client\Kernel\Container;
use Spryker\Client\PersistentCart\Plugin\DatabaseQuoteStorageStrategy;
use Spryker\Client\ProductBundle\Plugin\Cart\ItemCountPlugin;

class CartDependencyProvider extends SprykerCartDependencyProvider
{
    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addItemCountPlugin(Container $container)
    {
        $container[static::PLUGIN_ITEM_COUNT] = function (Container $container) {
            return new ItemCountPlugin();
        };

        return $container;
    }

    /**
     * @return \Spryker\Client\Cart\Dependency\Plugin\QuoteStorageStrategyPluginInterface[]
     */
    protected function getQuoteStorageStrategyPlugins()
    {
        $quoteStorageStrategyPlugins = parent::getQuoteStorageStrategyPlugins();
        $quoteStorageStrategyPlugins[] = new DatabaseQuoteStorageStrategy();

        return $quoteStorageStrategyPlugins;
    }
}
