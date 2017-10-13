<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CatalogPage;

use SprykerShop\Yves\CatalogPage\CatalogPageDependencyProvider as SprykerCatalogPageDependencyProvider;
use SprykerShop\Yves\CmsBlockWidget\Plugin\CatalogPage\CatalogCmsBlockWidgetPlugin;
use SprykerShop\Yves\ProductWidget\Plugin\CatalogPage\ProductWidgetPlugin;

class CatalogPageDependencyProvider extends SprykerCatalogPageDependencyProvider
{

    /**
     * @return \Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface[]
     */
    protected function getCatalogPageWidgetPlugins()
    {
        return [
            ProductWidgetPlugin::class,
            CatalogCmsBlockWidgetPlugin::class,
        ];
    }

}
