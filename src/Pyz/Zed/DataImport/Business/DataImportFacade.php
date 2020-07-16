<?php
/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */
namespace Pyz\Zed\DataImport\Business;
use Spryker\Zed\DataImport\Business\DataImportFacade as SprykerDataImportFacade;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
/**
 * @method \Pyz\Zed\DataImport\Business\DataImportBusinessFactory getFactory()
 */
class DataImportFacade extends SprykerDataImportFacade implements DataImportFacadeInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductPriceDataSet(DataSetInterface $dataSet): void
    {
        $this->getFactory()->createCombinedProductPricePropelDataSetWriter()->write($dataSet);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductPricePdoDataSet(DataSetInterface $dataSet): void
    {
        $this->getFactory()->createCombinedProductPriceBulkPdoDataSetWriter()->write($dataSet);
    }

    /**
     * @return void
     */
    public function flushCombinedProductPriceDataImporter(): void
    {
        $this->getFactory()->createCombinedProductPricePropelDataSetWriter()->flush();
    }

    /**
     * @return void
     */
    public function flushCombinedProductPricePdoDataImporter(): void
    {
        $this->getFactory()->createCombinedProductPriceBulkPdoDataSetWriter()->flush();
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductImageDataSet(DataSetInterface $dataSet): void
    {
        $this->getFactory()->createCombinedProductImagePropelDataSetWriter()->write($dataSet);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductImagePdoDataSet(DataSetInterface $dataSet): void
    {
        $this->getFactory()->createCombinedProductImageBulkPdoDataSetWriter()->write($dataSet);
    }

    /**
     * @return void
     */
    public function flushCombinedProductImageDataImporter(): void
    {
        $this->getFactory()->createCombinedProductImagePropelDataSetWriter()->flush();
    }

    /**
     * @return void
     */
    public function flushCombinedProductImagePdoDataImporter(): void
    {
        $this->getFactory()->createCombinedProductImageBulkPdoDataSetWriter()->flush();
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductStockDataSet(DataSetInterface $dataSet): void
    {
        $this->getFactory()->createCombinedProductStockPropelDataSetWriter()->write($dataSet);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductStockPdoDataSet(DataSetInterface $dataSet): void
    {
        $this->getFactory()->createCombinedProductStockBulkPdoDataSetWriter()->write($dataSet);
    }

    /**
     * @return void
     */
    public function flushCombinedProductStockDataImporter(): void
    {
        $this->getFactory()->createCombinedProductStockPropelDataSetWriter()->flush();
    }

    /**
     * @return void
     */
    public function flushCombinedProductStockPdoDataImporter(): void
    {
        $this->getFactory()->createCombinedProductStockBulkPdoDataSetWriter()->flush();
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductAbstractStoreDataSet(DataSetInterface $dataSet): void
    {
        $this->getFactory()->createCombinedProductAbstractStorePropelDataSetWriter()->write($dataSet);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductAbstractStorePdoDataSet(DataSetInterface $dataSet): void
    {
        $this->getFactory()->createCombinedProductAbstractStoreBulkPdoDataSetWriter()->write($dataSet);
    }

    /**
     * @return void
     */
    public function flushCombinedProductAbstractStoreDataImporter(): void
    {
        $this->getFactory()->createCombinedProductAbstractStorePropelDataSetWriter()->flush();
    }

    /**
     * @return void
     */
    public function flushCombinedProductAbstractStorePdoDataImporter(): void
    {
        $this->getFactory()->createCombinedProductAbstractStoreBulkPdoDataSetWriter()->flush();
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductAbstractDataSet(DataSetInterface $dataSet): void
    {
        $this->getFactory()->createCombinedProductAbstractPropelDataSetWriter()->write($dataSet);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductAbstractPdoDataSet(DataSetInterface $dataSet): void
    {
        $this->getFactory()->createCombinedProductAbstractBulkPdoDataSetWriter()->write($dataSet);
    }

    /**
     * @return void
     */
    public function flushCombinedProductAbstractDataImporter(): void
    {
        $this->getFactory()->createCombinedProductAbstractPropelDataSetWriter()->flush();
    }

    /**
     * @return void
     */
    public function flushCombinedProductAbstractPdoDataImporter(): void
    {
        $this->getFactory()->createCombinedProductAbstractBulkPdoDataSetWriter()->flush();
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductConcreteDataSet(DataSetInterface $dataSet): void
    {
        $this->getFactory()->createCombinedProductConcretePropelDataSetWriter()->write($dataSet);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function writeCombinedProductConcretePdoDataSet(DataSetInterface $dataSet): void
    {
        $this->getFactory()->createCombinedProductConcreteBulkPdoDataSetWriter()->write($dataSet);
    }

    /**
     * @return void
     */
    public function flushCombinedProductConcreteDataImporter(): void
    {
        $this->getFactory()->createCombinedProductConcretePropelDataSetWriter()->flush();
    }

    /**
     * @return void
     */
    public function flushCombinedProductConcretePdoDataImporter(): void
    {
        $this->getFactory()->createCombinedProductConcreteBulkPdoDataSetWriter()->flush();
    }
}
