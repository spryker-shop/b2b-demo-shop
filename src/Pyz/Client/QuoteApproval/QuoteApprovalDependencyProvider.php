<?php

namespace Pyz\Client\QuoteApproval;

use Spryker\Client\QuoteApproval\QuoteApprovalDependencyProvider as SprykerQuoteApprovalDependencyProvider;
use Spryker\Client\QuoteApprovalShipmentConnector\Plugin\QuoteApproval\ShipmentApplicableForQuoteApprovalCheckPlugin;

class QuoteApprovalDependencyProvider extends SprykerQuoteApprovalDependencyProvider
{
    /**
     * @return \Spryker\Client\QuoteApprovalExtension\Dependency\Plugin\QuoteApplicableForApprovalCheckPluginInterface[]
     */
    protected function getQuoteApplicableForApprovalCheckPlugins(): array
    {
        return [
            new ShipmentApplicableForQuoteApprovalCheckPlugin(),
        ];
    }
}
