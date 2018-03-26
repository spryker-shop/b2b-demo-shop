<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\ProductMeasurementSalesUnitStore;

use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitStoreQuery;
use Orm\Zed\Store\Persistence\SpyStoreQuery;
use Pyz\Zed\DataImport\Business\Exception\EntityNotFoundException;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class ProductMeasurementSalesUnitStoreWriterStep implements DataImportStepInterface
{
    const BULK_SIZE = 100;

    const KEY_SALES_UNIT_KEY = 'sales_unit_key';
    const KEY_STORE_NAME = 'store_name';

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
        SpyProductMeasurementSalesUnitStoreQuery::create()
            ->filterByFkProductMeasurementSalesUnit($this->getIdProductMeasurementSalesUnitByKey($dataSet[static::KEY_SALES_UNIT_KEY]))
            ->filterByFkStore($this->getIdStoreByName($dataSet[static::KEY_STORE_NAME]))
            ->findOneOrCreate()
            ->save();
    }

    /**
     * @param string $productMeasurementSalesUnitKey
     *
     * @throws \Pyz\Zed\DataImport\Business\Exception\EntityNotFoundException
     *
     * @return int
     */
    protected function getIdProductMeasurementSalesUnitByKey($productMeasurementSalesUnitKey)
    {
        $spyProductMeasurementSalesUnitEntity = SpyProductMeasurementSalesUnitQuery::create()
            ->findOneByKey($productMeasurementSalesUnitKey);

        if (!$spyProductMeasurementSalesUnitEntity) {
            throw new EntityNotFoundException(
                sprintf('Product measurement sales unit with key "%s" was not found during import.', $productMeasurementSalesUnitKey)
            );
        }

        return $spyProductMeasurementSalesUnitEntity->getIdProductMeasurementSalesUnit();
    }

    /**
     * @param string $storeName
     *
     * @return int
     */
    protected function getIdStoreByName($storeName)
    {
        if (!static::$idStoreBuffer) {
            $this->loadStoreIds();
        }

        return static::$idStoreBuffer[$storeName];
    }

    /**
     * @return void
     */
    protected function loadStoreIds()
    {
        static::$idStoreBuffer = SpyStoreQuery::create()
            ->find()
            ->toKeyValue('name', 'idStore');
    }
}
