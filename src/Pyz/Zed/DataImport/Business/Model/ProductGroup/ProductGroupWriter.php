<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\ProductGroup;

use Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery;
use Orm\Zed\ProductGroup\Persistence\SpyProductGroupQuery;
use Pyz\Zed\DataImport\Business\Model\Product\Repository\ProductRepository;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Pyz\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\DataImport\Dependency\Facade\DataImportToTouchInterface;
use Spryker\Zed\ProductGroup\Dependency\ProductGroupEvents;

class ProductGroupWriter extends PublishAwareStep implements DataImportStepInterface
{
    const BULK_SIZE = 100;

    const KEY_ABSTRACT_SKU = 'abstract_sku';
    const KEY_PRODUCT_GROUP_KEY = 'group_key';
    const KEY_POSITION = 'position';

    /**
     * @var \Pyz\Zed\DataImport\Business\Model\Product\Repository\ProductRepository
     */
    protected $productRepository;

    /**
     * @param \Pyz\Zed\DataImport\Business\Model\Product\Repository\ProductRepository $productRepository
     * @param \Spryker\Zed\DataImport\Dependency\Facade\DataImportToTouchInterface $touchFacade
     * @param int|null $bulkSize
     */
    public function __construct(ProductRepository $productRepository, DataImportToTouchInterface $touchFacade, $bulkSize = null)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $productGroupEntity = SpyProductGroupQuery::create()
            ->filterByProductGroupKey($dataSet[static::KEY_PRODUCT_GROUP_KEY])
            ->findOneOrCreate();

        $productGroupEntity->save();

        $idProductAbstract = $this->productRepository->getIdProductAbstractByAbstractSku($dataSet[static::KEY_ABSTRACT_SKU]);

        $productAbstractGroup = SpyProductAbstractGroupQuery::create()
            ->filterByFkProductAbstract($idProductAbstract)
            ->filterByFkProductGroup($productGroupEntity->getIdProductGroup())
            ->findOneOrCreate();

        $productAbstractGroup
            ->setPosition($dataSet[static::KEY_POSITION])
            ->save();

        $this->addPublishEvents(ProductGroupEvents::PRODUCT_GROUP_PUBLISH, $productAbstractGroup->getFkProductAbstract());
    }
}
