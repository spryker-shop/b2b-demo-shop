<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PersistentCart;

use Spryker\Zed\MultiCart\Communication\Plugin\CustomerCartQuoteResponseExpanderPlugin;
use Spryker\Zed\PersistentCart\PersistentCartDependencyProvider as SprykerPersistentCartDependencyProvider;
use Spryker\Zed\ProductBundle\Communication\Plugin\PersistentCart\BundleProductQuoteItemFinderPlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\PersistentCart\RemoveBundleChangeRequestExpanderPlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\SharedCartQuoteResponseExpanderPlugin;

class PersistentCartDependencyProvider extends SprykerPersistentCartDependencyProvider
{
    /**
     * @return \Spryker\Zed\PersistentCart\Dependency\Plugin\QuoteResponseExpanderPluginInterface[]
     */
    protected function getQuoteResponseExpanderPlugins()
    {
        return [
            new CustomerCartQuoteResponseExpanderPlugin(),
            new SharedCartQuoteResponseExpanderPlugin(), #SharedCartFeature
        ];
    }
    
    /**
     * @return \Spryker\Zed\PersistentCart\Dependency\Plugin\QuoteItemFinderPluginInterface
     */
    protected function getQuoteItemFinderPlugin()
    {
        return new BundleProductQuoteItemFinderPlugin(); #ProductBundleFeature
    }

    /**
     * @return \Spryker\Zed\PersistentCart\Dependency\Plugin\CartChangeRequestExpandPluginInterface[]
     */
    protected function getRemoveItemsRequestExpanderPlugins()
    {
        return [
            new RemoveBundleChangeRequestExpanderPlugin(), #ProductBundleFeature
        ];
    }
}
