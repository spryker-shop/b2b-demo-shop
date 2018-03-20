<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PersistentCart;

use Spryker\Zed\PersistentCart\PersistentCartDependencyProvider as SprykerPersistentCartDependencyProvider;
use Spryker\Zed\ProductBundle\Communication\Plugin\PersistentCart\BundleProductQuoteItemFinderPlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\PersistentCart\RemoveBundleChangeRequestExpanderPlugin;

class PersistentCartDependencyProvider extends SprykerPersistentCartDependencyProvider
{
    /**
     * @return \Spryker\Zed\PersistentCart\Dependency\Plugin\QuoteItemFinderPluginInterface
     */
    protected function getQuoteItemFinderPlugin()
    {
        return new BundleProductQuoteItemFinderPlugin();
    }

    /**
     * @return \Spryker\Zed\PersistentCart\Dependency\Plugin\CartChangeRequestExpandPluginInterface[]
     */
    protected function getRemoveItemsRequestExpanderPlugins()
    {
        return [
            new RemoveBundleChangeRequestExpanderPlugin(),
        ];
    }
}
