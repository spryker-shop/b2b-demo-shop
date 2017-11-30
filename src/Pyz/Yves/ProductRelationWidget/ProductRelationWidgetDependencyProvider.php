<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\ProductRelationWidget;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\ProductWidget\Plugin\ProductRelationWidget\ProductWidgetPlugin;
use SprykerShop\Yves\ProductRelationWidget\ProductRelationWidgetDependencyProvider as SprykerShopProductRelationWidgetDependencyProvider;

class ProductRelationWidgetDependencyProvider extends SprykerShopProductRelationWidgetDependencyProvider
{


    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return string[]
     */
    protected function getProductDetailPageSimilarProductsWidgetPlugins(Container $container): array
    {
        return [
            ProductWidgetPlugin::class,
        ];
    }



    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return string[]
     */
    protected function getCartPageUpSellingProductsWidgetPlugins(Container $container): array
    {
        return [
            ProductWidgetPlugin::class,
        ];
    }
}
