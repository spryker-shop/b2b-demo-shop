<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductLabelGui\Communication\Table;

use Orm\Zed\Category\Persistence\Map\SpyCategoryAttributeTableMap;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery;
use Spryker\Zed\Locale\Business\LocaleFacade;
use Spryker\Zed\ProductLabelGui\Communication\Table\RelatedProductOverviewTable as SprykerRelatedProductOverviewTable;

class RelatedProductOverviewTable extends SprykerRelatedProductOverviewTable
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

        $row[static::COL_PRODUCT_ABSTRACT_SKU] = $productAbstractEntity->getSku();
        $row[static::COL_PRODUCT_ABSTRACT_RELATION_COUNT] = $this->getAdditionalRelationCountColumn($productAbstractEntity);
        $row[static::COL_ACTIONS] = $this->getActionsColumn($productAbstractEntity);

        return $row;
    }

    /**
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract $productAbstractEntity
     *
     * @return int
     */
    protected function getAdditionalRelationCountColumn(SpyProductAbstract $productAbstractEntity)
    {
        return SpyProductLabelProductAbstractQuery::create()
                ->filterByFkProductAbstract($productAbstractEntity->getIdProductAbstract())
                ->count() - 1;
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
