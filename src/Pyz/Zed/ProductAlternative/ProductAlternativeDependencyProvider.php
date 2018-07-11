<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductAlternative;

use Spryker\Zed\ProductAlternative\ProductAlternativeDependencyProvider as SprykerProductAlternativeDependencyProvider;
use Spryker\Zed\ProductAlternativeProductLabelConnector\Communication\Plugin\PostProductAlternativeCreatePlugin;
use Spryker\Zed\ProductAlternativeProductLabelConnector\Communication\Plugin\PostProductAlternativeDeletePlugin;

class ProductAlternativeDependencyProvider extends SprykerProductAlternativeDependencyProvider
{
    /**
     * @return \Spryker\Zed\ProductAlternativeExtension\Dependency\Plugin\PostProductAlternativeCreatePluginInterface[]
     */
    protected function getPostProductAlternativeCreatePlugins(): array
    {
        return [
            new PostProductAlternativeCreatePlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\ProductAlternativeExtension\Dependency\Plugin\PostProductAlternativeDeletePluginInterface[]
     */
    protected function getPostProductAlternativeDeletePlugins(): array
    {
        return [
            new PostProductAlternativeDeletePlugin(),
        ];
    }
}
