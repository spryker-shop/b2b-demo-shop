<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\ProductMeasurementSalesUnitStore;

use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery;
use Orm\Zed\Store\Persistence\SpyStoreQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class ProductMeasurementSalesUnitStoreWriterStep implements DataImportStepInterface
{
    const BULK_SIZE = 100;

    const KEY_SALES_UNIT_KEY = 'sales_unit_key';
    const KEY_STORE_NAME = 'store_name';

    /**
     * @var int[] Keys are sales unit keys, values are sales unit ids.
     */
    protected static $idSalesUnitBuffer;

    /**
     * @var int[] Keys are store names, values are store ids.
     */
    protected static $idStoreBuffer;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        (new SpyProductMeasurementSalesUnitStoreQuery())
            ->filterByFkProductMeasurementSalesUnit($this->getIdProductMeasurementSalesUnitByKey($dataSet[static::KEY_SALES_UNIT_KEY]))
            ->filterByFkStore($this->getIdStoreByName($dataSet[static::KEY_STORE_NAME]))
            ->findOneOrCreate()
            ->save();
    }

    /**
     * @param string $salesUnitKey
     *
     * @return int
     */
    protected function getIdProductMeasurementSalesUnitByKey($salesUnitKey)
    {
        if (!isset(static::$idSalesUnitBuffer[$salesUnitKey])) {
            static::$idSalesUnitBuffer[$salesUnitKey] =
                SpyProductMeasurementSalesUnitQuery::create()->findOneByKey($salesUnitKey)->getIdProductMeasurementSalesUnit();
        }

        return static::$idSalesUnitBuffer[$salesUnitKey];
    }

    /**
     * @param string $storeName
     *
     * @return int
     */
    protected function getIdStoreByName($storeName)
    {
        if (!isset(static::$idStoreBuffer[$storeName])) {
            static::$idStoreBuffer[$storeName] =
                SpyStoreQuery::create()->findOneByName($storeName)->getIdStore();
        }

        return static::$idStoreBuffer[$storeName];
    }
}
