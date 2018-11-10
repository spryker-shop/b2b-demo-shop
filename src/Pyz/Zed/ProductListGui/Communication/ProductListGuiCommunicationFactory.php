<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductListGui\Communication;

use Pyz\Zed\ProductListGui\Communication\Form\DataProvider\ProductListCategoryRelationFormDataProvider;
use Spryker\Zed\ProductListGui\Communication\ProductListGuiCommunicationFactory as SprykerProductListGuiCommunicationFactory;

/**
 * @method \Spryker\Zed\ProductListGui\ProductListGuiConfig getConfig()
 */
class ProductListGuiCommunicationFactory extends SprykerProductListGuiCommunicationFactory
{
    /**
     * @return \Pyz\Zed\ProductListGui\Communication\Form\DataProvider\ProductListCategoryRelationFormDataProvider
     */
    public function createProductListCategoryRelationFormDataProvider()
    {
        return new ProductListCategoryRelationFormDataProvider(
            $this->getProductListFacade(),
            $this->getCategoryFacade(),
            $this->getLocaleFacade()
        );
    }
}
