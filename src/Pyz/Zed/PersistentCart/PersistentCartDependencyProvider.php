<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PersistentCart;

use Spryker\Zed\Kernel\Container;
use Spryker\Zed\MultiCart\Communication\Plugin\CustomerCartQuoteResponseExpanderPlugin;
use Spryker\Zed\PersistentCart\PersistentCartDependencyProvider as SprykerPersistentCartDependencyProvider;
use Spryker\Zed\PersistentCartExtension\Dependency\Plugin\QuoteItemFinderPluginInterface;
use Spryker\Zed\ProductBundle\Communication\Plugin\PersistentCart\BundleProductQuoteItemFinderPlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\PersistentCart\RemoveBundleChangeRequestExpanderPlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\PersistentCart\ProductPackagingUnitCartAddItemStrategyPlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\SharedCartQuoteResponseExpanderPlugin;

class PersistentCartDependencyProvider extends SprykerPersistentCartDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\PersistentCartExtension\Dependency\Plugin\QuoteResponseExpanderPluginInterface>
     */
    protected function getQuoteResponseExpanderPlugins(): array
    {
        return [
            new CustomerCartQuoteResponseExpanderPlugin(), #MultiCartFeature
            new SharedCartQuoteResponseExpanderPlugin(), #SharedCartFeature
        ];
    }

    /**
     * @return \Spryker\Zed\PersistentCartExtension\Dependency\Plugin\QuoteItemFinderPluginInterface
     */
    protected function getQuoteItemFinderPlugin(): QuoteItemFinderPluginInterface
    {
        return new BundleProductQuoteItemFinderPlugin(); #ProductBundleFeature
    }

    /**
     * @return array<\Spryker\Zed\PersistentCartExtension\Dependency\Plugin\CartChangeRequestExpandPluginInterface>
     */
    protected function getRemoveItemsRequestExpanderPlugins(): array
    {
        return [
            new RemoveBundleChangeRequestExpanderPlugin(), #ProductBundleFeature
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\CartExtension\Dependency\Plugin\CartOperationStrategyPluginInterface>
     */
    protected function getCartAddItemStrategyPlugins(Container $container): array
    {
        return [
            new ProductPackagingUnitCartAddItemStrategyPlugin(),
        ];
    }
}
