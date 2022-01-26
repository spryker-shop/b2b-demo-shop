<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
