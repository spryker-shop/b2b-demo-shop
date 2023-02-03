<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\QuoteRequest;

use Spryker\Client\ProductConfigurationCart\Plugin\QuoteRequest\ProductConfigurationQuoteRequestQuoteCheckPlugin;
use Spryker\Client\QuoteApproval\Plugin\QuoteRequest\QuoteApprovalQuoteRequestQuoteCheckPlugin;
use Spryker\Client\QuoteRequest\QuoteRequestDependencyProvider as SprykerQuoteRequestDependencyProvider;

class QuoteRequestDependencyProvider extends SprykerQuoteRequestDependencyProvider
{
    /**
     * @return array<\Spryker\Client\QuoteRequestExtension\Dependency\Plugin\QuoteRequestQuoteCheckPluginInterface>
     */
    protected function getQuoteRequestQuoteCheckPlugins(): array
    {
        return [
            new QuoteApprovalQuoteRequestQuoteCheckPlugin(),
            new ProductConfigurationQuoteRequestQuoteCheckPlugin(),
        ];
    }
}
