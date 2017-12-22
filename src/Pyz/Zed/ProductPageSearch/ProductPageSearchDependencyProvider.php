<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\ProductPageSearch;

use Spryker\Zed\ProductLabelPageSearch\Communication\Plugin\PageDataExpander\ProductLabelPageDataExpanderPlugin;
use Spryker\Zed\ProductLabelPageSearch\Communication\Plugin\PageMapExpander\ProductLabelPageMapExpanderPlugin;
use Spryker\Zed\ProductPageSearch\ProductPageSearchDependencyProvider as SprykerProductPageSearchDependencyProvider;

class ProductPageSearchDependencyProvider extends SprykerProductPageSearchDependencyProvider
{

    const PLUGIN_PRODUCT_LABEL_PAGE_DATA = 'PLUGIN_PRODUCT_LABEL_PAGE_DATA';

    /**
     * @return \Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageMapExpanderInterface[]
     */
    protected function getDataExpanderPlugins()
    {
        $dataExpanderPlugins = parent::getDataExpanderPlugins();
        $dataExpanderPlugins['PLUGIN_PRODUCT_LABEL_PAGE_DATA'] = new ProductLabelPageDataExpanderPlugin();

        return $dataExpanderPlugins;
    }

    /**
     * @return array|\Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageMapExpanderInterface[]
     */
    protected function getMapExpanderPlugins()
    {
        $mapExpanderPlugins = parent::getMapExpanderPlugins();
        $mapExpanderPlugins[] = new  ProductLabelPageMapExpanderPlugin();

        return $mapExpanderPlugins;
    }

}
