<?php



declare(strict_types = 1);

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
