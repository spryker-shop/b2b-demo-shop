<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductAlternative;

use Spryker\Zed\ProductAlternative\ProductAlternativeDependencyProvider as SprykerProductAlternativeDependencyProvider;
use Spryker\Zed\ProductAlternativeProductLabelConnector\Communication\Plugin\DeleteProductAlternativesPlugin;
use Spryker\Zed\ProductAlternativeProductLabelConnector\Communication\Plugin\PostProductUpdateAlternativesPlugin;

class ProductAlternativeDependencyProvider extends SprykerProductAlternativeDependencyProvider
{
    /**
     * @return \Spryker\Zed\ProductAlternativeExtension\Dependency\Plugin\PostProductUpdateAlternativesPluginInterface[]
     */
    protected function getPostProductAlternativePlugins(): array
    {
        return [
            new PostProductUpdateAlternativesPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\ProductAlternativeExtension\Dependency\Plugin\DeleteProductAlternativePluginInterface[]
     */
    protected function getDeleteProductAlternativePlugins(): array
    {
        return [
            new DeleteProductAlternativesPlugin(),
        ];
    }
}
