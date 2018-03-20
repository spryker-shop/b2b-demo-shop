<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\ProductQuantity;

use Orm\Zed\Product\Persistence\SpyProductQuery;
use Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery;
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

    const DEFAULT_MIN = 1;
    const DEFAULT_MAX = null;
    const DEFAULT_INTERVAL = 1;

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $idProductConcrete = SpyProductQuery::create()
            ->findOneBySku($dataSet[static::KEY_CONCRETE_SKU])
            ->getIdProduct();

        $productQuantityEntity = (new SpyProductQuantityQuery())
            ->filterByFkProduct($idProductConcrete)
            ->findOneOrCreate();

        $productQuantityEntity
            ->setQuantityMin($dataSet[static::KEY_QUANTITY_MIN] === "" ? static::DEFAULT_MIN : $dataSet[static::KEY_QUANTITY_MIN])
            ->setQuantityMax($dataSet[static::KEY_QUANTITY_MAX] === "" ? static::DEFAULT_MAX : $dataSet[static::KEY_QUANTITY_MAX])
            ->setQuantityInterval($dataSet[static::KEY_QUANTITY_INTERVAL] === "" ? static::DEFAULT_INTERVAL : $dataSet[static::KEY_QUANTITY_INTERVAL])
            ->save();

        $this->addPublishEvents(ProductQuantityEvents::PRODUCT_QUANTITY_PUBLISH, $productQuantityEntity->getFkProduct());
    }
}
