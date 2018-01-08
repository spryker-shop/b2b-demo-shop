<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\ProductPageSearch;

use Spryker\Shared\ProductLabelPageSearch\ProductLabelPageSearchConfig;
use Spryker\Shared\ProductReviewSearch\ProductReviewSearchConfig;
use Spryker\Zed\ProductLabelPageSearch\Communication\Plugin\PageDataExpander\ProductLabelPageDataExpanderPlugin;
use Spryker\Zed\ProductLabelPageSearch\Communication\Plugin\PageMapExpander\ProductLabelPageMapExpanderPlugin;
use Spryker\Zed\ProductPageSearch\ProductPageSearchDependencyProvider as SprykerProductPageSearchDependencyProvider;
use Spryker\Zed\ProductReviewSearch\Communication\Plugin\PageDataExpander\ProductReviewDataExpanderPlugin;
use Spryker\Zed\ProductReviewSearch\Communication\Plugin\PageMapExpander\ProductReviewMapExpanderPlugin;

class ProductPageSearchDependencyProvider extends SprykerProductPageSearchDependencyProvider
{

    const PLUGIN_PRODUCT_LABEL_PAGE_DATA = 'PLUGIN_PRODUCT_LABEL_PAGE_DATA';

    /**
     * @return \Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageMapExpanderInterface[]
     */
    protected function getDataExpanderPlugins()
    {
        $dataExpanderPlugins = parent::getDataExpanderPlugins();
        $dataExpanderPlugins[ProductLabelPageSearchConfig::PLUGIN_PRODUCT_LABEL_PAGE_DATA] = new ProductLabelPageDataExpanderPlugin();
        $dataExpanderPlugins[ProductReviewSearchConfig::PLUGIN_PRODUCT_PAGE_RATING_DATA] = new ProductReviewDataExpanderPlugin();

        return $dataExpanderPlugins;
    }

    /**
     * @return array|\Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageMapExpanderInterface[]
     */
    protected function getMapExpanderPlugins()
    {
        $mapExpanderPlugins = parent::getMapExpanderPlugins();
        $mapExpanderPlugins[] = new  ProductLabelPageMapExpanderPlugin();
        $mapExpanderPlugins[] = new  ProductReviewMapExpanderPlugin();

        return $mapExpanderPlugins;
    }

}
