<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductAlternativeProductLabelConnector;

use Spryker\Zed\ProductAlternativeProductLabelConnector\ProductAlternativeProductLabelConnectorDependencyProvider as SprykerProductAlternativeProductLabelConnectorDependencyProvider;
use Spryker\Zed\ProductDiscontinued\Communication\Plugin\ProductAlternativeProductLabelConnector\ProductConcreteDiscontinuedCheckPlugin;

class ProductAlternativeProductLabelConnectorDependencyProvider extends SprykerProductAlternativeProductLabelConnectorDependencyProvider
{
    /**
     * @return \Spryker\Zed\ProductAlternativeProductLabelConnector\Dependency\Plugin\ProductConcreteDiscontinuedCheckPluginInterface[]
     */
    protected function getProductConcreteDiscontinuedCheckPlugins()
    {
        return [
            new ProductConcreteDiscontinuedCheckPlugin(),
        ];
    }
}
