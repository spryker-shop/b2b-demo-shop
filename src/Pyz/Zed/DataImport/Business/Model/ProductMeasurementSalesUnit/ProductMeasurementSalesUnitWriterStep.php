<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\ProductMeasurementSalesUnit;

use Orm\Zed\Product\Persistence\SpyProductQuery;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery;
use Pyz\Zed\DataImport\Business\Exception\EntityNotFoundException;
use Pyz\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\ProductMeasurementUnit\Dependency\ProductMeasurementUnitEvents;

class ProductMeasurementSalesUnitWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    const BULK_SIZE = 100;

    const KEY_SALES_UNIT_KEY = 'sales_unit_key';
    const KEY_CONCRETE_SKU = 'concrete_sku';
    const KEY_CODE = 'code';
    const KEY_CONVERSION = 'conversion';
    const KEY_PRECISION = 'precision';
    const KEY_IS_DISPLAY = 'is_display';
    const KEY_IS_DEFAULT = 'is_default';

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
        $dataSet = $this->filterDataSet($dataSet);

        $spyProductEntity = $this->getProductBySku($dataSet[static::KEY_CONCRETE_SKU]);
        $spyProductMeasurementBaseUnitEntity = $this->getProductMeasurementBaseUnit($spyProductEntity->getFkProductAbstract());

        $spyProductMeasurementSalesUnitEntity = SpyProductMeasurementSalesUnitQuery::create()
            ->filterByKey($dataSet[static::KEY_SALES_UNIT_KEY])
            ->findOneOrCreate();

        $spyProductMeasurementSalesUnitEntity
            ->setFkProductMeasurementBaseUnit($spyProductMeasurementBaseUnitEntity->getIdProductMeasurementBaseUnit())
            ->setFkProduct($spyProductEntity->getIdProduct())
            ->setFkProductMeasurementUnit($this->getProductMeasurementUnitIdByCode($dataSet[static::KEY_CODE]))
            ->setConversion($dataSet[static::KEY_CONVERSION])
            ->setPrecision($dataSet[static::KEY_PRECISION])
            ->setIsDefault($dataSet[static::KEY_IS_DEFAULT])
            ->setIsDisplay($dataSet[static::KEY_IS_DISPLAY])
            ->save();

        $this->addPublishEvents(
            ProductMeasurementUnitEvents::PRODUCT_CONCRETE_MEASUREMENT_UNIT_PUBLISH,
            $spyProductMeasurementSalesUnitEntity->getFkProduct()
        );
    }

    /**
     * @param string $productConcreteSku
     *
     * @throws \Pyz\Zed\DataImport\Business\Exception\EntityNotFoundException
     *
     * @return \Orm\Zed\Product\Persistence\SpyProduct
     */
    protected function getProductBySku($productConcreteSku)
    {
        $spyProductEntity = SpyProductQuery::create()
            ->findOneBySku($productConcreteSku);

        if (!$spyProductEntity) {
            throw new EntityNotFoundException(
                sprintf('Product concrete with SKU "%s" was not found during import.', $productConcreteSku)
            );
        }

        return $spyProductEntity;
    }

    /**
     * @param int $idProductAbstract
     *
     * @throws \Pyz\Zed\DataImport\Business\Exception\EntityNotFoundException
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\Base\SpyProductMeasurementBaseUnit
     */
    protected function getProductMeasurementBaseUnit($idProductAbstract)
    {
        $spyProductMeasurementBaseUnitEntity = SpyProductMeasurementBaseUnitQuery::create()
            ->findOneByFkProductAbstract($idProductAbstract);

        if (!$spyProductMeasurementBaseUnitEntity) {
            throw new EntityNotFoundException(
                sprintf('Product measurement base unit was not found for product abstract id "%d" during data import.', $idProductAbstract)
            );
        }

        return $spyProductMeasurementBaseUnitEntity;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface
     */
    protected function filterDataSet(DataSetInterface $dataSet)
    {
        if ($dataSet[static::KEY_CONVERSION] === "") {
            $dataSet[static::KEY_CONVERSION] = null;
        }

        if ($dataSet[static::KEY_PRECISION] === "") {
            $dataSet[static::KEY_PRECISION] = null;
        }

        return $dataSet;
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
