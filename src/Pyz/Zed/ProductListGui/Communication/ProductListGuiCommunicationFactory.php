<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
