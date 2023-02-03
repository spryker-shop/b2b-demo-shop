<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\QuoteRequest;

use Spryker\Zed\ProductConfigurationCart\Communication\Plugin\QuoteRequest\ProductConfigurationQuoteRequestUserValidatorPlugin;
use Spryker\Zed\ProductConfigurationCart\Communication\Plugin\QuoteRequest\ProductConfigurationQuoteRequestValidatorPlugin;
use Spryker\Zed\QuoteApproval\Communication\Plugin\QuoteRequest\QuoteApprovalQuoteRequestPreCreateCheckPlugin;
use Spryker\Zed\QuoteRequest\QuoteRequestDependencyProvider as SprykerQuoteRequestDependencyProvider;

class QuoteRequestDependencyProvider extends SprykerQuoteRequestDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\QuoteRequestExtension\Dependency\Plugin\QuoteRequestPreCreateCheckPluginInterface>
     */
    protected function getQuoteRequestPreCreateCheckPlugins(): array
    {
        return [
            new QuoteApprovalQuoteRequestPreCreateCheckPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\QuoteRequestExtension\Dependency\Plugin\QuoteRequestValidatorPluginInterface>
     */
    protected function getQuoteRequestValidatorPlugins(): array
    {
        return [
            new ProductConfigurationQuoteRequestValidatorPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\QuoteRequestExtension\Dependency\Plugin\QuoteRequestUserValidatorPluginInterface>
     */
    protected function getQuoteRequestUserValidatorPlugins(): array
    {
        return [
            new ProductConfigurationQuoteRequestUserValidatorPlugin(),
        ];
    }
}
