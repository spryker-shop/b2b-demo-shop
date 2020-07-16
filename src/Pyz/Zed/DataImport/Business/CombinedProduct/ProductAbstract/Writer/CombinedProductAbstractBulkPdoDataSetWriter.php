<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\CombinedProduct\ProductAbstract\Writer;

use Pyz\Zed\DataImport\Business\CombinedProduct\ProductAbstract\CombinedProductAbstractHydratorStep;
use Pyz\Zed\DataImport\Business\Model\DataFormatter\DataImportDataFormatterInterface;
use Pyz\Zed\DataImport\Business\Model\ProductAbstract\Writer\ProductAbstractBulkPdoDataSetWriter;
use Pyz\Zed\DataImport\Business\Model\ProductAbstract\Writer\Sql\ProductAbstractSqlInterface;
use Pyz\Zed\DataImport\Business\Model\PropelExecutorInterface;

class CombinedProductAbstractBulkPdoDataSetWriter extends ProductAbstractBulkPdoDataSetWriter
{
    protected const COLUMN_ABSTRACT_SKU = CombinedProductAbstractHydratorStep::COLUMN_ABSTRACT_SKU;
    protected const COLUMN_NEW_FROM = CombinedProductAbstractHydratorStep::COLUMN_NEW_FROM;
    protected const COLUMN_COLOR_CODE = CombinedProductAbstractHydratorStep::COLUMN_COLOR_CODE;
    protected const COLUMN_META_KEYWORDS = CombinedProductAbstractHydratorStep::COLUMN_META_KEYWORDS;
    protected const COLUMN_META_DESCRIPTION = CombinedProductAbstractHydratorStep::COLUMN_META_DESCRIPTION;
    protected const COLUMN_META_TITLE = CombinedProductAbstractHydratorStep::COLUMN_META_TITLE;
    protected const COLUMN_DESCRIPTION = CombinedProductAbstractHydratorStep::COLUMN_DESCRIPTION;
    protected const COLUMN_NAME = CombinedProductAbstractHydratorStep::COLUMN_NAME;
    protected const COLUMN_URL = CombinedProductAbstractHydratorStep::COLUMN_URL;
    protected const COLUMN_NEW_TO = CombinedProductAbstractHydratorStep::COLUMN_NEW_TO;

    /**
     * @param \Pyz\Zed\DataImport\Business\Model\ProductAbstract\Writer\Sql\ProductAbstractSqlInterface $productAbstractSql
     * @param \Pyz\Zed\DataImport\Business\Model\PropelExecutorInterface $propelExecutor
     * @param \Pyz\Zed\DataImport\Business\Model\DataFormatter\DataImportDataFormatterInterface $dataFormatter
     */
    public function __construct(
        ProductAbstractSqlInterface $productAbstractSql,
        PropelExecutorInterface $propelExecutor,
        DataImportDataFormatterInterface $dataFormatter
    ) {
        parent::__construct($productAbstractSql, $propelExecutor, $dataFormatter);
    }
}
