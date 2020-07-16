<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\CombinedProduct\ProductImage\Writer;

use Pyz\Zed\DataImport\Business\CombinedProduct\ProductImage\CombinedProductImageHydratorStep;
use Pyz\Zed\DataImport\Business\Model\DataFormatter\DataImportDataFormatterInterface;
use Pyz\Zed\DataImport\Business\Model\ProductImage\Writer\ProductImageBulkPdoDataSetWriter;
use Pyz\Zed\DataImport\Business\Model\ProductImage\Writer\Sql\ProductImageSqlInterface;
use Pyz\Zed\DataImport\Business\Model\PropelExecutorInterface;

class CombinedProductImageBulkPdoDataSetWriter extends ProductImageBulkPdoDataSetWriter
{
    protected const COLUMN_EXTERNAL_URL_LARGE = CombinedProductImageHydratorStep::COLUMN_EXTERNAL_URL_LARGE;
    protected const COLUMN_EXTERNAL_URL_SMALL = CombinedProductImageHydratorStep::COLUMN_EXTERNAL_URL_SMALL;
    protected const COLUMN_PRODUCT_IMAGE_KEY = CombinedProductImageHydratorStep::COLUMN_PRODUCT_IMAGE_KEY;
    protected const COLUMN_SORT_ORDER = CombinedProductImageHydratorStep::COLUMN_SORT_ORDER;

    /**
     * @param \Pyz\Zed\DataImport\Business\Model\ProductImage\Writer\Sql\ProductImageSqlInterface $productImageSql
     * @param \Pyz\Zed\DataImport\Business\Model\PropelExecutorInterface $propelExecutor
     * @param \Pyz\Zed\DataImport\Business\Model\DataFormatter\DataImportDataFormatterInterface $dataFormatter
     */
    public function __construct(
        ProductImageSqlInterface $productImageSql,
        PropelExecutorInterface $propelExecutor,
        DataImportDataFormatterInterface $dataFormatter
    ) {
        parent::__construct($productImageSql, $propelExecutor, $dataFormatter);
    }
}
