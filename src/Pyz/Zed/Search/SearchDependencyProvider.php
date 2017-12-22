<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Search;

use Spryker\Zed\CategoryPageSearch\Communication\Plugin\Search\CategoryNodeDataPageMapBuilder;
use Spryker\Zed\CmsPageSearch\Communication\Plugin\Search\CmsDataPageMapBuilder;
use Spryker\Zed\ProductPageSearch\Communication\Plugin\Search\ProductPageMapPlugin;
use Spryker\Zed\ProductSetPageSearch\Communication\Plugin\Search\ProductSetPageMapPlugin;
use Spryker\Zed\Search\SearchDependencyProvider as SprykerSearchDependencyProvider;

class SearchDependencyProvider extends SprykerSearchDependencyProvider
{

    /**
     * @return \Spryker\Zed\Search\Dependency\Plugin\PageMapInterface[]
     */
    protected function getSearchPageMapPlugins()
    {
        return [
            new ProductPageMapPlugin(),
            new ProductSetPageMapPlugin(),
            new CmsDataPageMapBuilder(),
            new CategoryNodeDataPageMapBuilder(),
        ];
    }

}
