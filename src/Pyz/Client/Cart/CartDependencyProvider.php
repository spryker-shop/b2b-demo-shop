<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Cart;

use Spryker\Client\Cart\CartDependencyProvider as SprykerCartDependencyProvider;
use Spryker\Client\DiscountPromotion\Plugin\AddDiscountPromotionCartRequestExpandPlugin;
use Spryker\Client\PersistentCart\Plugin\DatabaseQuoteStorageStrategy;
use Spryker\Client\ProductBundle\Plugin\Cart\BundleProductQuoteItemFinderPlugin;
use Spryker\Client\ProductBundle\Plugin\Cart\BundledItemCounterPlugin;
use Spryker\Client\ProductBundle\Plugin\Cart\RemoveBundleChangeRequestExpanderPlugin;

class CartDependencyProvider extends SprykerCartDependencyProvider
{
    /**
     * @return \Spryker\Client\Cart\Dependency\Plugin\ItemCounterPluginInterface
     */
    protected function getItemCountPlugin()
    {
        return new BundledItemCounterPlugin();
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

    /**
     * @return \Spryker\Client\Cart\Dependency\Plugin\QuoteItemFinderPluginInterface
     */
    protected function getQuoteItemFinderPlugin()
    {
        return new BundleProductQuoteItemFinderPlugin();
    }

    /**
     * @return \Spryker\Client\Cart\Dependency\Plugin\CartChangeRequestExpanderPluginInterface[]
     */
    protected function getAddItemsRequestExpanderPlugins()
    {
        return [
            new AddDiscountPromotionCartRequestExpandPlugin(),
        ];
    }

    /**
     * @return \Spryker\Client\Cart\Dependency\Plugin\CartChangeRequestExpanderPluginInterface[]
     */
    protected function getRemoveItemsRequestExpanderPlugins()
    {
        return [
            new RemoveBundleChangeRequestExpanderPlugin(),
        ];
    }
}
