<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Category\Business;

use Pyz\Zed\Category\Business\Map\CategoryNodeDataPageMapBuilder;
use Spryker\Zed\Category\Business\CategoryBusinessFactory as SprykerCategoryBusinessFactory;

/**
 * @method \Spryker\Zed\Category\Persistence\CategoryQueryContainer getQueryContainer()
 * @method \Pyz\Zed\Category\CategoryConfig getConfig()
 */
class CategoryBusinessFactory extends SprykerCategoryBusinessFactory
{
    /**
     * @return \Pyz\Zed\Category\Business\Map\CategoryNodeDataPageMapBuilder
     */
    public function createCategoryNodeDataPageMapBuilder()
    {
        return new CategoryNodeDataPageMapBuilder();
    }
}
