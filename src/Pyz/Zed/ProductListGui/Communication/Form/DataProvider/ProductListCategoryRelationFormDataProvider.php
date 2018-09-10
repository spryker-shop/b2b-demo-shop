<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\ProductListGui\Communication\Form\DataProvider;

use Generated\Shared\Transfer\ProductListCategoryRelationTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\ProductListGui\Communication\Form\ProductListAggregateFormType;
use Spryker\Zed\ProductListGui\Communication\Form\DataProvider\ProductListCategoryRelationFormDataProvider as SprykerProductListCategoryRelationFormDataProvider;
use Spryker\Zed\ProductListGui\Dependency\Facade\ProductListGuiToCategoryFacadeInterface;
use Spryker\Zed\ProductListGui\Dependency\Facade\ProductListGuiToLocaleFacadeInterface;
use Spryker\Zed\ProductListGui\Dependency\Facade\ProductListGuiToProductListFacadeInterface;

class ProductListCategoryRelationFormDataProvider extends SprykerProductListCategoryRelationFormDataProvider
{
    /**
     * @return array
     */
    public function getOptions(): array
    {
        $categoryCollectionTransfer = $this->categoryFacade->getAllCategoryCollection($this->localeFacade->getCurrentLocale());
        $categoryOptions = [];

        foreach ($categoryCollectionTransfer->getCategories() as $categoryTransfer) {
            foreach ($categoryTransfer->getNodeCollection()->getNodes() as $nodeTransfer) {
                $path = sprintf('%s/%s', $nodeTransfer->getPath(), $categoryTransfer->getName());
                $categoryOptions[$path] = $categoryTransfer->getIdCategory();
            }
        }

        return [
            ProductListAggregateFormType::OPTION_CATEGORY_IDS => array_flip($categoryOptions),
        ];
    }
}
