<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductLabelGui\Communication\Table;

class AssignedProductTable extends AbstractRelatedProductRelationTable
{
    /**
     * @var string
     */
    protected $tableIdentifier = 'assigned-product-table';

    /**
     * @var string
     */
    protected $defaultUrl = 'assigned-product-table';

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    protected function getQuery()
    {
        return $this->tableQueryBuilder->buildAssignedProductQuery($this->idProductLabel);
    }

    /**
     * @return string
     */
    protected function getCheckboxCheckedAttribute()
    {
        return 'checked="checked"';
    }
}
