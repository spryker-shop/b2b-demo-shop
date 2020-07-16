<?php
/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */
namespace Pyz\Zed\DataImport\Business;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
/**
 * @method \Pyz\Zed\DataImport\Business\DataImportBusinessFactory getFactory()
 */
interface DataImportFacadeInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductPriceDataSet(DataSetInterface $dataSet): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductPricePdoDataSet(DataSetInterface $dataSet): void;

    /**
     * @return void
     */
    public function flushCombinedProductPriceDataImporter();

    /**
     * @return void
     */
    public function flushCombinedProductPricePdoDataImporter(): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductImageDataSet(DataSetInterface $dataSet): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductImagePdoDataSet(DataSetInterface $dataSet): void;

    /**
     * @return void
     */
    public function flushCombinedProductImageDataImporter(): void;

    /**
     * @return void
     */
    public function flushCombinedProductImagePdoDataImporter(): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductStockDataSet(DataSetInterface $dataSet): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductStockPdoDataSet(DataSetInterface $dataSet): void;

    /**
     * @return void
     */
    public function flushCombinedProductStockDataImporter(): void;

    /**
     * @return void
     */
    public function flushCombinedProductStockPdoDataImporter(): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductAbstractStoreDataSet(DataSetInterface $dataSet): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductAbstractStorePdoDataSet(DataSetInterface $dataSet): void;

    /**
     * @return void
     */
    public function flushCombinedProductAbstractStoreDataImporter(): void;

    /**
     * @return void
     */
    public function flushCombinedProductAbstractStorePdoDataImporter(): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductAbstractDataSet(DataSetInterface $dataSet): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductAbstractPdoDataSet(DataSetInterface $dataSet): void;

    /**
     * @return void
     */
    public function flushCombinedProductAbstractDataImporter(): void;

    /**
     * @return void
     */
    public function flushCombinedProductAbstractPdoDataImporter(): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductConcreteDataSet(DataSetInterface $dataSet): void;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductConcretePdoDataSet(DataSetInterface $dataSet): void;

    /**
     * @return void
     */
    public function flushCombinedProductConcreteDataImporter(): void;

    /**
     * @return void
     */
    public function flushCombinedProductConcretePdoDataImporter(): void;
}
