<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\ProductLabelGui\Communication\Table;

use Orm\Zed\Category\Persistence\Map\SpyCategoryAttributeTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use Spryker\Zed\Locale\Business\LocaleFacade;
use Spryker\Zed\ProductLabelGui\Communication\Table\AbstractRelatedProductTable as SprykerAbstractRelatedProductTable;

abstract class AbstractRelatedProductTable extends SprykerAbstractRelatedProductTable
{
    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config)
    {
        $query = $this->getQuery();

        /** @var \Orm\Zed\Product\Persistence\SpyProductAbstract[] $productAbstractEntities */
        $productAbstractEntities = $this->runQuery($query, $config, true);

        $productAbstractIds = [];
        foreach ($productAbstractEntities as $productAbstractEntity) {
            $productAbstractIds[] = $productAbstractEntity->getIdProductAbstract();
        }

        $categoryNames = $this->getCategoryNames($productAbstractIds);
        $rows = [];
        foreach ($productAbstractEntities as $productAbstractEntity) {
            $rows[] = [
                static::COL_PRODUCT_ABSTRACT_NAME => $this->getNameColumn($productAbstractEntity),
                static::COL_PRODUCT_ABSTRACT_CATEGORIES => $categoryNames[$productAbstractEntity->getIdProductAbstract()],
                static::COL_PRODUCT_ABSTRACT_PRICE => $this->getPriceColumn($productAbstractEntity),
                static::COL_PRODUCT_ABSTRACT_STATUS => $this->getStatusColumn($productAbstractEntity),
                static::COL_SELECT_CHECKBOX => $this->getSelectCheckboxColumn($productAbstractEntity),
                SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT => $productAbstractEntity->getIdProductAbstract(),
                SpyProductAbstractTableMap::COL_SKU => $productAbstractEntity->getSku(),
            ];
        }

        return $rows;
    }

    /**
     * @param array $categoryNames
     * @param int $idProductAbstract
     *
     * @return string
     */
    protected function getCategoryNameColumn(array $categoryNames, int $idProductAbstract): string
    {
        return implode(', ', $categoryNames[$idProductAbstract]);
    }

    /**
     * @param int[] $productAbstractIds
     *
     * @return string[]
     */
    protected function getCategoryNames(array $productAbstractIds): array
    {
        //TODO: Should be refactored to avoid instantiating of LocaleFacade
        $localeTransfer = (new LocaleFacade())->getCurrentLocale();

        $spyProductCategories = SpyProductCategoryQuery::create()
            ->filterByFkProductAbstract_In($productAbstractIds)
            ->joinSpyCategory()
                ->useSpyCategoryQuery()
                ->joinAttribute()
                    ->useAttributeQuery()
                    ->filterByFkLocale($localeTransfer->getIdLocale())
                    ->withColumn(SpyCategoryAttributeTableMap::COL_NAME, 'name')
                    ->endUse()
                ->endUse()
            ->find();

        $categoryNames = [];
        foreach ($spyProductCategories as $spyProductCategory) {
            $categoryNames[$spyProductCategory->getFkProductAbstract()][] = $spyProductCategory->getVirtualColumn(static::NAME);
        }

        return $categoryNames;
    }
}
