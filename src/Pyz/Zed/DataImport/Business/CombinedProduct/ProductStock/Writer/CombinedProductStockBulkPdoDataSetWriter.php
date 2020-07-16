<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\CombinedProduct\ProductStock\Writer;

use Pyz\Zed\DataImport\Business\CombinedProduct\ProductStock\CombinedProductStockHydratorStep;
use Pyz\Zed\DataImport\Business\Model\DataFormatter\DataImportDataFormatterInterface;
use Pyz\Zed\DataImport\Business\Model\ProductStock\Writer\ProductStockBulkPdoDataSetWriter;
use Pyz\Zed\DataImport\Business\Model\ProductStock\Writer\Sql\ProductStockSqlInterface;
use Pyz\Zed\DataImport\Business\Model\PropelExecutorInterface;
use Spryker\Zed\ProductBundle\Business\ProductBundleFacadeInterface;
use Spryker\Zed\Stock\Business\StockFacadeInterface;
use Spryker\Zed\Store\Business\StoreFacadeInterface;

class CombinedProductStockBulkPdoDataSetWriter extends ProductStockBulkPdoDataSetWriter
{
    public const BULK_SIZE = CombinedProductStockHydratorStep::BULK_SIZE;

    protected const COLUMN_NAME = CombinedProductStockHydratorStep::COLUMN_NAME;
    protected const COLUMN_CONCRETE_SKU = CombinedProductStockHydratorStep::COLUMN_CONCRETE_SKU;
    protected const COLUMN_IS_BUNDLE = CombinedProductStockHydratorStep::COLUMN_IS_BUNDLE;
    protected const COLUMN_QUANTITY = CombinedProductStockHydratorStep::COLUMN_QUANTITY;
    protected const COLUMN_IS_NEVER_OUT_OF_STOCK = CombinedProductStockHydratorStep::COLUMN_IS_NEVER_OUT_OF_STOCK;

    /**
     * @param \Spryker\Zed\Stock\Business\StockFacadeInterface $stockFacade
     * @param \Spryker\Zed\ProductBundle\Business\ProductBundleFacadeInterface $productBundleFacade
     * @param \Pyz\Zed\DataImport\Business\Model\ProductStock\Writer\Sql\ProductStockSqlInterface $productStockSql
     * @param \Pyz\Zed\DataImport\Business\Model\PropelExecutorInterface $propelExecutor
     * @param \Spryker\Zed\Store\Business\StoreFacadeInterface $storeFacade
     * @param \Pyz\Zed\DataImport\Business\Model\DataFormatter\DataImportDataFormatterInterface $dataFormatter
     */
    public function __construct(
        StockFacadeInterface $stockFacade,
        ProductBundleFacadeInterface $productBundleFacade,
        ProductStockSqlInterface $productStockSql,
        PropelExecutorInterface $propelExecutor,
        StoreFacadeInterface $storeFacade,
        DataImportDataFormatterInterface $dataFormatter
    ) {
        parent::__construct($stockFacade, $productBundleFacade, $productStockSql, $propelExecutor, $storeFacade, $dataFormatter);
    }
}
