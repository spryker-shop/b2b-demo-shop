<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\ProductLabelGui\Communication\Table;

use Orm\Zed\Category\Persistence\Map\SpyCategoryAttributeTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery;
use Spryker\Zed\Locale\Business\LocaleFacade;
use Spryker\Zed\ProductLabelGui\Communication\Table\AbstractRelatedProductRelationTable as SprykerAbstractRelatedProductRelationTable;

abstract class AbstractRelatedProductRelationTable extends SprykerAbstractRelatedProductRelationTable
{
    /**
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract $productAbstractEntity
     *
     * @return array
     */
    protected function getRow(SpyProductAbstract $productAbstractEntity)
    {
        $row = [
            static::COL_PRODUCT_ABSTRACT_NAME => $this->getNameColumn($productAbstractEntity),
            static::COL_PRODUCT_ABSTRACT_CATEGORIES => $this->getCategories($productAbstractEntity->getIdProductAbstract()),
            static::COL_PRODUCT_ABSTRACT_PRICE => $this->getPriceColumn($productAbstractEntity),
            static::COL_PRODUCT_ABSTRACT_STATUS => $this->getStatusColumn($productAbstractEntity),
        ];

        $row[static::COL_SELECT_CHECKBOX] = $this->getSelectCheckboxColumn($productAbstractEntity);
        $row[SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT] = $productAbstractEntity->getIdProductAbstract();
        $row[SpyProductAbstractTableMap::COL_SKU] = $productAbstractEntity->getSku();

        return $row;
    }

    /**
     * @param int $idProductAbstract
     *
     * @return string
     */
    protected function getCategories(int $idProductAbstract): string
    {
        //TODO: Should be refactored to avoid instantiating of LocaleFacade
        $localeTransfer = (new LocaleFacade())->getCurrentLocale();

        return SpyProductCategoryQuery::create()
            ->filterByFkProductAbstract($idProductAbstract)
            ->joinSpyCategory()
                ->useSpyCategoryQuery()
                ->joinAttribute()
                    ->useAttributeQuery()
                    ->filterByFkLocale($localeTransfer->getIdLocale())
                    ->withColumn(SpyCategoryAttributeTableMap::COL_NAME, 'name')
                    ->endUse()
                ->endUse()
            ->findOne()
            ->getVirtualColumn('name');
    }
}
