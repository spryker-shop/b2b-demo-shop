<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\ProductMeasurementUnit;

use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementUnitQuery;
use Pyz\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\ProductMeasurementUnit\Dependency\ProductMeasurementUnitEvents;

class ProductMeasurementUnitWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    const BULK_SIZE = 100;

    const KEY_DEFAULT_PRECISION = 'default_precision';
    const KEY_NAME = 'name';
    const KEY_CODE = 'code';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $productMeasurementUnitEntity = (new SpyProductMeasurementUnitQuery())
            ->filterByCode($dataSet[static::KEY_CODE])
            ->findOneOrCreate();

        $productMeasurementUnitEntity
            ->setName($dataSet[static::KEY_NAME])
            ->setDefaultPrecision($this->filterDefaultPrecision($dataSet[static::KEY_DEFAULT_PRECISION]))
            ->save();

        $this->addPublishEvents(ProductMeasurementUnitEvents::PRODUCT_MEASUREMENT_UNIT_PUBLISH, $productMeasurementUnitEntity->getIdProductMeasurementUnit());
    }

    /**
     * @param int|float|string $defaultPrecision
     *
     * @return int
     */
    protected function filterDefaultPrecision($defaultPrecision)
    {
        if ($defaultPrecision === "") {
            return 1;
        }

        return (int)$defaultPrecision;
    }
}
