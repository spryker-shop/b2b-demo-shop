<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Quote;

use Spryker\Zed\MultiCart\Communication\Plugin\AddDefaultNameBeforeQuoteSavePlugin;
use Spryker\Zed\MultiCart\Communication\Plugin\DeactivateQuotesBeforeQuoteSavePlugin;
use Spryker\Zed\MultiCart\Communication\Plugin\ResolveQuoteNameBeforeQuoteCreatePlugin;
use Spryker\Zed\Quote\QuoteDependencyProvider as SprykerQuoteDependencyProvider;
use Spryker\Zed\SharedCart\Communication\Plugin\UpdateShareDetailsQuoteAfterSavePlugin;

class QuoteDependencyProvider extends SprykerQuoteDependencyProvider
{
    /**
     * @return \Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteWritePluginInterface[]
     */
    protected function getQuoteCreateAfterPlugins(): array
    {
        return [
            new UpdateShareDetailsQuoteAfterSavePlugin(), #SharedCartFeature
        ];
    }

    /**
     * @return \Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteWritePluginInterface[]
     */
    protected function getQuoteCreateBeforePlugins(): array
    {
        return [
            new AddDefaultNameBeforeQuoteSavePlugin(), #MultiCartFeature
            new ResolveQuoteNameBeforeQuoteCreatePlugin(), #MultiCartFeature
            new DeactivateQuotesBeforeQuoteSavePlugin(), #MultiCartFeature
        ];
    }

    /**
     * @return \Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteWritePluginInterface[]
     */
    protected function getQuoteUpdateAfterPlugins(): array
    {
        return [
            new UpdateShareDetailsQuoteAfterSavePlugin(), #SharedCartFeature
        ];
    }

    /**
     * @return \Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteWritePluginInterface[]
     */
    protected function getQuoteUpdateBeforePlugins(): array
    {
        return [
            new AddDefaultNameBeforeQuoteSavePlugin(), #MultiCartFeature
            new DeactivateQuotesBeforeQuoteSavePlugin(), #MultiCartFeature
        ];
    }
}
