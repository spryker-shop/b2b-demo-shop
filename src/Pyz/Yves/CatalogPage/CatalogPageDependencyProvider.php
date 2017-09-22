<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CatalogPage;

use SprykerShop\Yves\CatalogPage\CatalogPageDependencyProvider as SprykerCatalogPageDependencyProvider;
use SprykerShop\Yves\ProductGroupWidget\Plugin\CatalogPage\ProductGroupWidgetBuilderPlugin;
use SprykerShop\Yves\ProductReviewWidget\Plugin\CatalogPage\ProductReviewWidgetBuilderPlugin;

class CatalogPageDependencyProvider extends SprykerCatalogPageDependencyProvider
{

    /**
     * @return \Spryker\Yves\Kernel\Dependency\Plugin\WidgetBuilderPluginInterface[]
     */
    protected function getCatalogWidgetBuilderPlugins()
    {
        return [
            new ProductGroupWidgetBuilderPlugin(),
            new ProductReviewWidgetBuilderPlugin(),
        ];
    }

}
