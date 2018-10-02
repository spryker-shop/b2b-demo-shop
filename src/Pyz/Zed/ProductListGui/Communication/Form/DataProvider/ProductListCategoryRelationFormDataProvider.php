<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductListGui\Communication\Form\DataProvider;

use Spryker\Zed\ProductListGui\Communication\Form\DataProvider\ProductListCategoryRelationFormDataProvider as SprykerProductListCategoryRelationFormDataProvider;
use Spryker\Zed\ProductListGui\Communication\Form\ProductListAggregateFormType;

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
