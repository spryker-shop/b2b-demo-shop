<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\PersistentCart;

use Spryker\Client\MultiCart\Plugin\DefaultQuoteUpdatePlugin;
use Spryker\Client\MultiCart\Plugin\QuoteSelectorPersistentCartChangeExpanderPlugin;
use Spryker\Client\MultiCart\Plugin\SaveCustomerQuotesQuoteUpdatePlugin;
use Spryker\Client\PersistentCart\PersistentCartDependencyProvider as SprykerPersistentCartDependencyProvider;
use Spryker\Client\ProductMeasurementUnit\Plugin\PersistentCart\SingleItemQuantitySalesUnitPersistentCartChangeExpanderPlugin;
use Spryker\Client\SharedCart\Plugin\PermissionUpdateQuoteUpdatePlugin;
use Spryker\Client\SharedCart\Plugin\ProductSeparatePersistentCartChangeExpanderPlugin;
use Spryker\Client\SharedCart\Plugin\SharedCartsUpdateQuoteUpdatePlugin;

class PersistentCartDependencyProvider extends SprykerPersistentCartDependencyProvider
{
    /**
     * @return \Spryker\Client\PersistentCartExtension\Dependency\Plugin\QuoteUpdatePluginInterface[]
     */
    protected function getQuoteUpdatePlugins(): array
    {
        return [
            new SaveCustomerQuotesQuoteUpdatePlugin(), #MultiCartFeature
            new DefaultQuoteUpdatePlugin(), #MultiCartFeature
            new PermissionUpdateQuoteUpdatePlugin(), #SharedCartFeature
            new SharedCartsUpdateQuoteUpdatePlugin(), #SharedCartFeature
        ];
    }

    /**
     * @return \Spryker\Client\PersistentCartExtension\Dependency\Plugin\PersistentCartChangeExpanderPluginInterface[]
     */
    protected function getChangeRequestExtendPlugins(): array
    {
        return [
            new QuoteSelectorPersistentCartChangeExpanderPlugin(), #MultiCartFeature
            new ProductSeparatePersistentCartChangeExpanderPlugin(), #SharedCartFeature
            new SingleItemQuantitySalesUnitPersistentCartChangeExpanderPlugin(),
        ];
    }
}
