<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business;

use Spryker\Zed\DataImport\Business\DataImportFacadeInterface as SprykerDataImportFacadeInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

/**
 * @method \Pyz\Zed\DataImport\Business\DataImportBusinessFactory getFactory()
 */
interface DataImportFacadeInterface extends SprykerDataImportFacadeInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     */
    public function writeProductAbstractDataSet(DataSetInterface $dataSet): void;

    public function flushProductAbstractDataImporter(): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     */
    public function writeProductConcreteDataSet(DataSetInterface $dataSet): void;

    public function flushProductConcreteDataImporter(): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     */
    public function writeProductImageDataSet(DataSetInterface $dataSet): void;

    public function flushProductImageDataImporter(): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     */
    public function writeProductStockDataSet(DataSetInterface $dataSet): void;

    public function flushProductStockDataImporter(): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     */
    public function writeProductAbstractStoreDataSet(DataSetInterface $dataSet): void;

    public function flushProductAbstractStoreDataImporter(): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     */
    public function writeCombinedProductPriceDataSet(DataSetInterface $dataSet): void;

    public function flushCombinedProductPriceDataImporter(): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     */
    public function writeCombinedProductImageDataSet(DataSetInterface $dataSet): void;

    public function flushCombinedProductImageDataImporter(): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     */
    public function writeCombinedProductStockDataSet(DataSetInterface $dataSet): void;

    public function flushCombinedProductStockDataImporter(): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     */
    public function writeCombinedProductAbstractStoreDataSet(DataSetInterface $dataSet): void;

    public function flushCombinedProductAbstractStoreDataImporter(): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     */
    public function writeCombinedProductAbstractDataSet(DataSetInterface $dataSet): void;

    public function flushCombinedProductAbstractDataImporter(): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     */
    public function writeCombinedProductConcreteDataSet(DataSetInterface $dataSet): void;

    public function flushCombinedProductConcreteDataImporter(): void;
}
