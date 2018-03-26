<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\ProductMeasurementBaseUnit;

use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery;
use Pyz\Zed\DataImport\Business\Exception\EntityNotFoundException;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class ProductMeasurementBaseUnitWriterStep implements DataImportStepInterface
{
    const BULK_SIZE = 100;

    const KEY_CODE = 'code';
    const KEY_ABSTRACT_SKU = 'abstract_sku';

    /**
     * @var int[] Keys are product measurement unit codes, values are product measurement unit ids.
     */
    protected static $productMeasurementUnitIdBuffer;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $spyBaseUnitEntity = SpyProductMeasurementBaseUnitQuery::create()
            ->filterByFkProductAbstract($this->getIdProductAbstractBySku($dataSet[static::KEY_ABSTRACT_SKU]))
            ->findOneOrCreate();

        $spyBaseUnitEntity
            ->setFkProductMeasurementUnit($this->getProductMeasurementUnitIdByCode($dataSet[static::KEY_CODE]))
            ->save();
    }

    /**
     * @param string $productAbstractSku
     *
     * @throws \Pyz\Zed\DataImport\Business\Exception\EntityNotFoundException
     *
     * @return int
     */
    protected function getIdProductAbstractBySku($productAbstractSku)
    {
        $spyProductAbstractEntity = SpyProductAbstractQuery::create()->findOneBySku($productAbstractSku);

        if (!$spyProductAbstractEntity) {
            throw new EntityNotFoundException(
                sprintf('Product abstract with SKU "%s" was not found during import.', $productAbstractSku)
            );
        }

        return $spyProductAbstractEntity->getIdProductAbstract();
    }

    /**
     * @param string $productMeasurementUnitCode
     *
     * @return int
     */
    protected function getProductMeasurementUnitIdByCode($productMeasurementUnitCode)
    {
        if (!static::$productMeasurementUnitIdBuffer) {
            $this->loadProductMeasurementUnitIds();
        }

        return static::$productMeasurementUnitIdBuffer[$productMeasurementUnitCode];
    }

    /**
     * @return void
     */
    protected function loadProductMeasurementUnitIds()
    {
        static::$productMeasurementUnitIdBuffer = SpyProductMeasurementUnitQuery::create()
            ->find()
            ->toKeyValue('code', 'idProductMeasurementUnit');
    }
}
