<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\QuoteRequestPage;

use SprykerShop\Yves\QuoteRequestPage\Plugin\QuoteRequestPage\DeliveryDateMetadataFieldPlugin;
use SprykerShop\Yves\QuoteRequestPage\Plugin\QuoteRequestPage\NoteMetadataFieldPlugin;
use SprykerShop\Yves\QuoteRequestPage\Plugin\QuoteRequestPage\PurchaseOrderNumberMetadataFieldPlugin;
use SprykerShop\Yves\QuoteRequestPage\QuoteRequestPageDependencyProvider as SprykerQuoteRequestPageDependencyProvider;

class QuoteRequestPageDependencyProvider extends SprykerQuoteRequestPageDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\QuoteRequestPageExtension\Dependency\Plugin\QuoteRequestFormMetadataFieldPluginInterface>
     */
    protected function getQuoteRequestFormMetadataFieldPlugins(): array
    {
        return [
            new PurchaseOrderNumberMetadataFieldPlugin(),
            new DeliveryDateMetadataFieldPlugin(),
            new NoteMetadataFieldPlugin(),
        ];
    }
}
