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
use Spryker\Client\SharedCart\Plugin\PermissionUpdateQuoteUpdatePlugin;
use Spryker\Client\SharedCart\Plugin\ProductSeparatePersistentCartChangeExpanderPlugin;
use Spryker\Client\SharedCart\Plugin\SharedCartsUpdateQuoteUpdatePlugin;

class PersistentCartDependencyProvider extends SprykerPersistentCartDependencyProvider
{
    /**
     * @return \Spryker\Client\PersistentCart\Dependency\Plugin\QuoteUpdatePluginInterface[]
     */
    protected function getQuoteUpdatePlugins()
    {
        return [
            new SaveCustomerQuotesQuoteUpdatePlugin(), #MultiCartFeature
            new DefaultQuoteUpdatePlugin(), #MultiCartFeature
            new PermissionUpdateQuoteUpdatePlugin(), #SharedCartFeature
            new SharedCartsUpdateQuoteUpdatePlugin(), #SharedCartFeature
        ];
    }

    /**
     * @return \Spryker\Client\PersistentCart\Dependency\Plugin\PersistentCartChangeExpanderPluginInterface[]
     */
    protected function getChangeRequestExtendPlugins()
    {
        return [
            new QuoteSelectorPersistentCartChangeExpanderPlugin(), #MultiCartFeature
            new ProductSeparatePersistentCartChangeExpanderPlugin(), #SharedCartFeature
        ];
    }
}
