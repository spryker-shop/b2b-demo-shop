<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\QuoteRequestsRestApi;

use Spryker\Glue\ConfigurableBundlesRestApi\Plugin\QuoteRequestsRestApi\ConfiguredBundleRestQuoteRequestAttributesExpanderPlugin;
use Spryker\Glue\DiscountsRestApi\Plugin\QuoteRequestsRestApi\DiscountsRestQuoteRequestAttributesExpanderPlugin;
use Spryker\Glue\ProductMeasurementUnitsRestApi\Plugin\QuoteRequestsRestApi\SalesUnitRestQuoteRequestAttributesExpanderPlugin;
use Spryker\Glue\ProductOptionsRestApi\Plugin\QuoteRequestsRestApi\ProductOptionsRestQuoteRequestAttributesExpanderPlugin;
use Spryker\Glue\QuoteRequestsRestApi\QuoteRequestsRestApiDependencyProvider as SprykerQuoteRequestsRestApiDependencyProvider;
use Spryker\Glue\ShipmentsRestApi\Plugin\QuoteRequestsRestApi\ShipmentsRestQuoteRequestAttributesExpanderPlugin;

class QuoteRequestsRestApiDependencyProvider extends SprykerQuoteRequestsRestApiDependencyProvider
{
    /**
     * @return \Spryker\Glue\QuoteRequestsRestApiExtension\Dependency\Plugin\RestQuoteRequestAttributesExpanderPluginInterface[]
     */
    protected function getRestQuoteRequestAttributesExpanderPlugins(): array
    {
        return [
            new ProductOptionsRestQuoteRequestAttributesExpanderPlugin(),
            new SalesUnitRestQuoteRequestAttributesExpanderPlugin(),
            new ConfiguredBundleRestQuoteRequestAttributesExpanderPlugin(),
            new ShipmentsRestQuoteRequestAttributesExpanderPlugin(),
            new DiscountsRestQuoteRequestAttributesExpanderPlugin(),
        ];
    }
}
