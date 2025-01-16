<?php



declare(strict_types = 1);

namespace Pyz\Zed\CartNote;

use Spryker\Zed\CartNote\CartNoteDependencyProvider as SprykerCartNoteDependencyProvider;
use Spryker\Zed\CartNoteExtension\Dependency\Plugin\QuoteItemFinderPluginInterface;
use Spryker\Zed\CartNoteProductBundleConnector\Communication\Plugin\BundleProductQuoteItemFinderPlugin;

class CartNoteDependencyProvider extends SprykerCartNoteDependencyProvider
{
    /**
     * @return \Spryker\Zed\CartNoteExtension\Dependency\Plugin\QuoteItemFinderPluginInterface
     */
    protected function getQuoteItemsFinderPlugin(): QuoteItemFinderPluginInterface
    {
        return new BundleProductQuoteItemFinderPlugin();
    }
}
