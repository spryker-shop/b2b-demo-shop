<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductDiscontinued;

use Spryker\Zed\ProductDiscontinued\ProductDiscontinuedDependencyProvider as SprykerProductDiscontinuedDependencyProvider;
use Spryker\Zed\ProductDiscontinuedProductBundleConnector\Communication\Plugin\DiscontinueBundlePostProductDiscontinuePlugin;

class ProductDiscontinuedDependencyProvider extends SprykerProductDiscontinuedDependencyProvider
{
    /**
     * @return \Spryker\Zed\ProductDiscontinuedExtension\Dependency\Plugin\PostProductDiscontinuePluginInterface[]
     */
    protected function getPostProductDiscontinuePlugins(): array
    {
        return [
            new DiscontinueBundlePostProductDiscontinuePlugin(),
        ];
    }
}
