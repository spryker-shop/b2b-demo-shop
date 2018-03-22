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
use Pyz\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\ProductMeasurementUnit\Dependency\ProductMeasurementUnitEvents;

class ProductMeasurementSalesUnitWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    const BULK_SIZE = 100;

    const KEY_SALES_UNIT_KEY = 'sales_unit_key';
    const KEY_ABSTRACT_SKU = 'abstract_sku';
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
        $productMeasurementSalesUnitEntity = (new SpyProductMeasurementSalesUnitQuery())
            ->filterByKey($dataSet[static::KEY_SALES_UNIT_KEY])
            ->findOneOrCreate();

        /** @var \Orm\Zed\Product\Persistence\SpyProduct $productConcreteEntity */
        $productConcreteEntity = (new SpyProductQuery())
            ->filterBySku($dataSet[static::KEY_CONCRETE_SKU])
            ->joinWithSpyProductAbstract()
            ->useSpyProductAbstractQuery()
                ->filterBySku($dataSet[static::KEY_ABSTRACT_SKU])
            ->endUse()
            ->find()
            ->getFirst();

        $productMeasurementBaseUnitEntity = SpyProductMeasurementBaseUnitQuery::create()
            ->findOneByFkProductAbstract($productConcreteEntity->getSpyProductAbstract()->getIdProductAbstract());

        $productMeasurementSalesUnitEntity
            ->setFkProductMeasurementBaseUnit($productMeasurementBaseUnitEntity->getIdProductMeasurementBaseUnit())
            ->setFkProduct($productConcreteEntity->getIdProduct())
            ->setFkProductMeasurementUnit($this->getProductMeasurementUnitIdByCode($dataSet[static::KEY_CODE]))
            ->setConversion($dataSet[static::KEY_CONVERSION] === "" ? null: $dataSet[static::KEY_CONVERSION])
            ->setPrecision($dataSet[static::KEY_PRECISION] === "" ? null : $dataSet[static::KEY_PRECISION])
            ->setIsDefault($dataSet[static::KEY_IS_DEFAULT])
            ->setIsDisplay($dataSet[static::KEY_IS_DISPLAY])
            ->save();

        $this->addPublishEvents(
            ProductMeasurementUnitEvents::PRODUCT_CONCRETE_MEASUREMENT_UNIT_PUBLISH,
            $productMeasurementSalesUnitEntity->getFkProduct()
        );
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
