<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductLabelGui\Communication\Table;

class AvailableProductTable extends AbstractRelatedProductRelationTable
{
    /**
     * @var string
     */
    protected $tableIdentifier = 'available-product-table';

    /**
     * @var string
     */
    protected $defaultUrl = 'available-product-table';

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    protected function getQuery()
    {
        return $this->tableQueryBuilder->buildAvailableProductQuery($this->idProductLabel);
    }

    /**
     * @return string
     */
    protected function getCheckboxCheckedAttribute()
    {
        return '';
    }
}
