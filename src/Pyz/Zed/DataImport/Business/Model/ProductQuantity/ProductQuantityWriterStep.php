<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\ProductQuantity;

use Orm\Zed\Product\Persistence\SpyProductQuery;
use Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery;
use Pyz\Zed\DataImport\Business\Exception\EntityNotFoundException;
use Pyz\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\ProductQuantity\Dependency\ProductQuantityEvents;

class ProductQuantityWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    const BULK_SIZE = 100;

    const KEY_CONCRETE_SKU = 'concrete_sku';
    const KEY_QUANTITY_MIN = 'quantity_min';
    const KEY_QUANTITY_MAX = 'quantity_max';
    const KEY_QUANTITY_INTERVAL = 'quantity_interval';

    const DEFAULT_MAX = null;
    const DEFAULT_INTERVAL = 1;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $dataSet = $this->filterDataSet($dataSet);

        $idProduct = $this->getIdProductBySku($dataSet[static::KEY_CONCRETE_SKU]);

        $spyProductQuantityEntity = SpyProductQuantityQuery::create()
            ->filterByFkProduct($idProduct)
            ->findOneOrCreate();

        $spyProductQuantityEntity
            ->setQuantityMin($dataSet[static::KEY_QUANTITY_MIN])
            ->setQuantityMax($dataSet[static::KEY_QUANTITY_MAX])
            ->setQuantityInterval($dataSet[static::KEY_QUANTITY_INTERVAL])
            ->save();

        $this->addPublishEvents(ProductQuantityEvents::PRODUCT_QUANTITY_PUBLISH, $spyProductQuantityEntity->getFkProduct());
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface
     */
    protected function filterDataSet(DataSetInterface $dataSet)
    {
        if ($dataSet[static::KEY_QUANTITY_INTERVAL] === "") {
            $dataSet[static::KEY_QUANTITY_INTERVAL] = static::DEFAULT_INTERVAL;
        }

        if ($dataSet[static::KEY_QUANTITY_MIN] === "") {
            $dataSet[static::KEY_QUANTITY_MIN] = $dataSet[static::KEY_QUANTITY_INTERVAL];
        }

        if ($dataSet[static::KEY_QUANTITY_MAX] === "") {
            $dataSet[static::KEY_QUANTITY_MAX] = static::DEFAULT_MAX;
        }

        return $dataSet;
    }

    /**
     * @param string $productConcreteSku
     *
     * @throws \Pyz\Zed\DataImport\Business\Exception\EntityNotFoundException
     *
     * @return int
     */
    protected function getIdProductBySku($productConcreteSku)
    {
        $spyProductEntity = SpyProductQuery::create()->findOneBySku($productConcreteSku);

        if (!$spyProductEntity) {
            throw new EntityNotFoundException(
                sprintf('Product concrete with "%s" SKU was not found during data import', $productConcreteSku)
            );
        }

        return $spyProductEntity->getIdProduct();
    }
}
