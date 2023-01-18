<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\QuoteRequestAgentPage;

use SprykerShop\Yves\QuoteRequestAgentPage\Plugin\QuoteRequestAgentPage\DeliveryDateMetadataFieldPlugin;
use SprykerShop\Yves\QuoteRequestAgentPage\Plugin\QuoteRequestAgentPage\NoteMetadataFieldPlugin;
use SprykerShop\Yves\QuoteRequestAgentPage\Plugin\QuoteRequestAgentPage\PurchaseOrderNumberMetadataFieldPlugin;
use SprykerShop\Yves\QuoteRequestAgentPage\QuoteRequestAgentPageDependencyProvider as SprykerQuoteRequestAgentPageDependencyProvider;

class QuoteRequestAgentPageDependencyProvider extends SprykerQuoteRequestAgentPageDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\QuoteRequestAgentPageExtension\Dependency\Plugin\QuoteRequestAgentFormMetadataFieldPluginInterface>
     */
    protected function getQuoteRequestAgentFormMetadataFieldPlugins(): array
    {
        return [
            new PurchaseOrderNumberMetadataFieldPlugin(),
            new DeliveryDateMetadataFieldPlugin(),
            new NoteMetadataFieldPlugin(),
        ];
    }
}
