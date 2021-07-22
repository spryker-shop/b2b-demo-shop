<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductLabelGui\Communication\Table;

use Orm\Zed\ProductLabel\Persistence\Map\SpyProductLabelProductAbstractTableMap;
use Spryker\Zed\ProductLabelGui\Communication\Table\RelatedProductTableQueryBuilder as SprykerRelatedProductTableQueryBuilder;

class RelatedProductTableQueryBuilder extends SprykerRelatedProductTableQueryBuilder
{
    /**
     * @param int|null $idProductLabel
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function buildAvailableProductQuery($idProductLabel = null)
    {
        $query = $this->build($idProductLabel);

        $query->where(sprintf(
            '%s IS NULL',
            SpyProductLabelProductAbstractTableMap::COL_FK_PRODUCT_LABEL
        ));

        return $query;
    }

    /**
     * @param int|null $idProductLabel
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function buildAssignedProductQuery($idProductLabel = null)
    {
        $query = $this->build($idProductLabel);

        $query->where(sprintf(
            '%s IS NOT NULL',
            SpyProductLabelProductAbstractTableMap::COL_FK_PRODUCT_LABEL
        ));

        return $query;
    }

    /**
     * @param int|null $idProductLabel

     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    protected function build($idProductLabel = null)
    {
        $query = $this->productQueryContainer->queryProductAbstract();
        $localeTransfer = $this->localeFacade->getCurrentLocale();

        $this->addProductName($query, $localeTransfer);
        $this->addConcreteProductStates($query);
        $this->addRelation($query, $idProductLabel);

        return $query;
    }
}
