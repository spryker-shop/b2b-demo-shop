<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\ProductStock\Writer;

use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\Availability\Persistence\Map\SpyAvailabilityAbstractTableMap;
use Orm\Zed\Availability\Persistence\Map\SpyAvailabilityTableMap;
use Orm\Zed\Availability\Persistence\SpyAvailabilityAbstract;
use Orm\Zed\Availability\Persistence\SpyAvailabilityAbstractQuery;
use Orm\Zed\Availability\Persistence\SpyAvailabilityQuery;
use Orm\Zed\Oms\Persistence\Map\SpyOmsProductReservationTableMap;
use Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery;
use Orm\Zed\Oms\Persistence\SpyOmsProductReservationStoreQuery;
use Orm\Zed\Stock\Persistence\Map\SpyStockProductTableMap;
use Orm\Zed\Stock\Persistence\SpyStock;
use Orm\Zed\Stock\Persistence\SpyStockProductQuery;
use Orm\Zed\Stock\Persistence\SpyStockQuery;
use Pyz\Zed\DataImport\Business\Model\Product\Repository\ProductRepositoryInterface;
use Pyz\Zed\DataImport\Business\Model\ProductStock\ProductStockHydratorStep;
use Spryker\DecimalObject\Decimal;
use Spryker\Zed\Availability\Dependency\AvailabilityEvents;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetWriterInterface;
use Spryker\Zed\DataImport\Business\Model\Publisher\DataImporterPublisher;
use Spryker\Zed\ProductBundle\Business\ProductBundleFacadeInterface;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Stock\Business\StockFacadeInterface;
use Spryker\Zed\Store\Business\StoreFacadeInterface;

class ProductStockPropelDataSetWriter implements DataSetWriterInterface
{
    protected const COLUMN_CONCRETE_SKU = ProductStockHydratorStep::COLUMN_CONCRETE_SKU;

    protected const COLUMN_IS_BUNDLE = ProductStockHydratorStep::COLUMN_IS_BUNDLE;

    protected const COLUMN_IS_NEVER_OUT_OF_STOCK = ProductStockHydratorStep::COLUMN_IS_NEVER_OUT_OF_STOCK;

    protected const KEY_AVAILABILITY_SKU = 'KEY_AVAILABILITY_SKU';

    protected const KEY_AVAILABILITY_QUANTITY = 'KEY_AVAILABILITY_QUANTITY';

    protected const KEY_AVAILABILITY_ID_STORE = 'KEY_AVAILABILITY_ID_STORE';

    protected const KEY_AVAILABILITY_IS_NEVER_OUT_OF_STOCK = 'KEY_AVAILABILITY_IS_NEVER_OUT_OF_STOCK';

    protected const KEY_AVAILABILITY_ID_AVAILABILITY_ABSTRACT = 'KEY_AVAILABILITY_ID_AVAILABILITY_ABSTRACT';

    protected const COL_AVAILABILITY_TOTAL_QUANTITY = 'availabilityTotalQuantity';

    protected const COL_STOCK_PRODUCT_TOTAL_QUANTITY = 'stockProductTotalQuantity';

    /**
     * @var array<string, array<int, \Orm\Zed\Availability\Persistence\SpyAvailabilityAbstract>>
     */
    protected static array $availabilityAbstractEntitiesIndexedByAbstractSkuAndIdStore = [];

    /**
     * @var array<string>
     */
    protected static array $productAbstractSkus = [];

    protected ProductRepositoryInterface $productRepository;

    protected ProductBundleFacadeInterface $productBundleFacade;

    protected StoreFacadeInterface $storeFacade;

    protected StockFacadeInterface $stockFacade;

    public function __construct(
        ProductBundleFacadeInterface $productBundleFacade,
        ProductRepositoryInterface $productRepository,
        StoreFacadeInterface $storeFacade,
        StockFacadeInterface $stockFacade,
    ) {
        $this->productBundleFacade = $productBundleFacade;
        $this->productRepository = $productRepository;
        $this->storeFacade = $storeFacade;
        $this->stockFacade = $stockFacade;
    }

    public function write(DataSetInterface $dataSet): void
    {
        $stockEntity = $this->createOrUpdateStock($dataSet);
        $this->createOrUpdateProductStock($dataSet, $stockEntity);
        $this->collectProductAbstractSku($dataSet);
        $this->updateAvailability($dataSet);

        if ($dataSet[static::COLUMN_IS_BUNDLE]) {
            $this->productBundleFacade->updateBundleAvailability($dataSet[static::COLUMN_CONCRETE_SKU]);
        } else {
            $this->productBundleFacade->updateAffectedBundlesAvailability($dataSet[static::COLUMN_CONCRETE_SKU]);
            $this->productBundleFacade->updateAffectedBundlesStock($dataSet[static::COLUMN_CONCRETE_SKU]);
        }
    }

    public function flush(): void
    {
        $this->triggerAvailabilityPublishEvents();
        $this->productRepository->flush();
    }

    protected function createOrUpdateStock(DataSetInterface $dataSet): SpyStock
    {
        $stockTransfer = $dataSet[ProductStockHydratorStep::STOCK_ENTITY_TRANSFER];
        $stockEntity = SpyStockQuery::create()
            ->filterByName($stockTransfer->getName())
            ->findOneOrCreate();
        $stockEntity->fromArray($stockTransfer->modifiedToArray());
        $stockEntity->save();

        return $stockEntity;
    }

    protected function createOrUpdateProductStock(DataSetInterface $dataSet, SpyStock $stockEntity): void
    {
        $stockProductEntityTransfer = $dataSet[ProductStockHydratorStep::STOCK_PRODUCT_ENTITY_TRANSFER];
        $idProductConcrete = $this->productRepository->getIdProductByConcreteSku($dataSet[static::COLUMN_CONCRETE_SKU]);
        $stockProductEntity = SpyStockProductQuery::create()
            ->filterByFkProduct($idProductConcrete)
            ->filterByFkStock($stockEntity->getIdStock())
            ->findOneOrCreate();
        $stockProductEntity->fromArray($stockProductEntityTransfer->modifiedToArray());
        $stockProductEntity->save();
    }

    protected function collectProductAbstractSku(DataSetInterface $dataSet): void
    {
        $productConcreteSku = $dataSet[static::COLUMN_CONCRETE_SKU];
        static::$productAbstractSkus[] = $this->productRepository->getAbstractSkuByConcreteSku($productConcreteSku);
    }

    protected function triggerAvailabilityPublishEvents(): void
    {
        $availabilityAbstractIds = $this->getAvailabilityAbstractIdsForCollectedAbstractSkus();

        foreach ($availabilityAbstractIds as $availabilityAbstractId) {
            DataImporterPublisher::addEvent(AvailabilityEvents::AVAILABILITY_ABSTRACT_PUBLISH, $availabilityAbstractId);
        }
    }

    /**
     * @return array<int>
     */
    protected function getAvailabilityAbstractIdsForCollectedAbstractSkus(): array
    {
        $storeIds = $this->getStoreIds();

        return SpyAvailabilityAbstractQuery::create()
            ->joinWithSpyAvailability()
            ->filterByAbstractSku_In(static::$productAbstractSkus)
            ->useSpyAvailabilityQuery()
                ->filterByFkStore_In($storeIds)
            ->endUse()
            ->select([
                SpyAvailabilityAbstractTableMap::COL_ID_AVAILABILITY_ABSTRACT,
            ])
            ->find()
            ->getData();
    }

    /**
     * @return array<int>
     */
    protected function getStoreIds(): array
    {
        $storeIds = [];

        foreach ($this->storeFacade->getAllStores() as $storeTransfer) {
            $storeIds[] = $storeTransfer->getIdStoreOrFail();
        }

        return $storeIds;
    }

    protected function updateAvailability(DataSetInterface $dataSet): void
    {
        foreach ($this->storeFacade->getAllStores() as $storeTransfer) {
            $this->updateAvailabilityForStore($dataSet, $storeTransfer);
        }
    }

    protected function updateAvailabilityForStore(DataSetInterface $dataSet, StoreTransfer $storeTransfer): void
    {
        $concreteSku = $dataSet[static::COLUMN_CONCRETE_SKU];
        $abstractSku = $this->productRepository->getAbstractSkuByConcreteSku($concreteSku);
        $idStore = $this->getIdStore($storeTransfer);

        $availabilityQuantity = $this->getProductAvailabilityForStore($concreteSku, $storeTransfer);
        $availabilityAbstractEntity = $this->getAvailabilityAbstract($abstractSku, $idStore);
        $this->persistAvailabilityData([
            static::KEY_AVAILABILITY_SKU => $concreteSku,
            static::KEY_AVAILABILITY_QUANTITY => $availabilityQuantity,
            static::KEY_AVAILABILITY_ID_AVAILABILITY_ABSTRACT => $availabilityAbstractEntity->getIdAvailabilityAbstract(),
            static::KEY_AVAILABILITY_ID_STORE => $idStore,
            static::KEY_AVAILABILITY_IS_NEVER_OUT_OF_STOCK => $dataSet[static::COLUMN_IS_NEVER_OUT_OF_STOCK],
        ]);

        $this->updateAbstractAvailabilityQuantity($availabilityAbstractEntity, $idStore);
    }

    protected function getProductAvailabilityForStore(string $concreteSku, StoreTransfer $storeTransfer): Decimal
    {
        $physicalItems = $this->calculateProductStockForSkuAndStore($concreteSku, $storeTransfer);
        $reservedItems = $this->getReservationQuantityForStore($concreteSku, $storeTransfer);
        $stockProductQuantity = $physicalItems->subtract($reservedItems);

        return $stockProductQuantity->greatherThanOrEquals(0) ? $stockProductQuantity : new Decimal(0);
    }

    protected function calculateProductStockForSkuAndStore(string $concreteSku, StoreTransfer $storeTransfer): Decimal
    {
        $idProductConcrete = $this->productRepository->getIdProductByConcreteSku($concreteSku);
        $stockNames = $this->getStoreWarehouses($storeTransfer->getName());

        return $this->getStockProductQuantityByIdProductAndStockNames($idProductConcrete, $stockNames);
    }

    /**
     * @param string $storeName
     *
     * @return array<string>
     */
    protected function getStoreWarehouses(string $storeName): array
    {
        return $this->stockFacade->getStoreToWarehouseMapping()[$storeName] ?? [];
    }

    /**
     * @param int $idProductConcrete
     * @param array<string> $stockNames
     */
    protected function getStockProductQuantityByIdProductAndStockNames(
        int $idProductConcrete,
        array $stockNames,
    ): Decimal {
        $stockProductTotalQuantity = SpyStockProductQuery::create()
            ->filterByFkProduct($idProductConcrete)
            ->useStockQuery()
                ->filterByName($stockNames, Criteria::IN)
            ->endUse()
            ->withColumn(sprintf('SUM(%s)', SpyStockProductTableMap::COL_QUANTITY), static::COL_STOCK_PRODUCT_TOTAL_QUANTITY)
            ->select([static::COL_STOCK_PRODUCT_TOTAL_QUANTITY])
            ->findOne();

        return new Decimal($stockProductTotalQuantity ?? 0);
    }

    protected function getReservationQuantityForStore(string $sku, StoreTransfer $storeTransfer): Decimal
    {
        $idStore = $this->getIdStore($storeTransfer);

        /** @var \Propel\Runtime\Collection\ArrayCollection $productReservations */
        $productReservations = SpyOmsProductReservationQuery::create()
            ->filterBySku($sku)
            ->filterByFkStore($idStore)
            ->select([
                SpyOmsProductReservationTableMap::COL_RESERVATION_QUANTITY,
            ])
            ->find();

        $reservationQuantity = new Decimal(0);

        foreach ($productReservations->toArray() as $productReservationQuantity) {
            $reservationQuantity = $reservationQuantity->add($productReservationQuantity);
        }

        $reservationQuantity = $reservationQuantity->add($this->getReservationsFromOtherStores($sku, $storeTransfer));

        return $reservationQuantity;
    }

    protected function getReservationsFromOtherStores(string $sku, StoreTransfer $currentStoreTransfer): Decimal
    {
        $reservationQuantity = new Decimal(0);
        $reservationStores = SpyOmsProductReservationStoreQuery::create()
            ->filterBySku($sku)
            ->find();

        foreach ($reservationStores as $omsProductReservationStoreEntity) {
            if ($omsProductReservationStoreEntity->getStore() === $currentStoreTransfer->getName()) {
                continue;
            }

            $reservationQuantity = $reservationQuantity->add($omsProductReservationStoreEntity->getReservationQuantity());
        }

        return $reservationQuantity;
    }

    protected function getIdStore(StoreTransfer $storeTransfer): int
    {
        if (!$storeTransfer->getIdStore()) {
            $idStore = $this->storeFacade
                ->getStoreByName($storeTransfer->getName())
                ->getIdStore();
            $storeTransfer->setIdStore($idStore);
        }

        return $storeTransfer->getIdStore();
    }

    /**
     * @param array<string, mixed> $availabilityData
     */
    protected function persistAvailabilityData(array $availabilityData): void
    {
        $spyAvailabilityEntity = SpyAvailabilityQuery::create()
            ->filterByFkStore($availabilityData[static::KEY_AVAILABILITY_ID_STORE])
            ->filterBySku($availabilityData[static::KEY_AVAILABILITY_SKU])
            ->findOneOrCreate();

        $spyAvailabilityEntity->setFkAvailabilityAbstract($availabilityData[static::KEY_AVAILABILITY_ID_AVAILABILITY_ABSTRACT]);
        $spyAvailabilityEntity->setQuantity($availabilityData[static::KEY_AVAILABILITY_QUANTITY]);
        $spyAvailabilityEntity->setIsNeverOutOfStock($availabilityData[static::KEY_AVAILABILITY_IS_NEVER_OUT_OF_STOCK]);

        $spyAvailabilityEntity->save();
    }

    protected function getAvailabilityAbstract(string $abstractSku, int $idStore): SpyAvailabilityAbstract
    {
        if (!empty(static::$availabilityAbstractEntitiesIndexedByAbstractSkuAndIdStore[$abstractSku][$idStore])) {
            return static::$availabilityAbstractEntitiesIndexedByAbstractSkuAndIdStore[$abstractSku][$idStore];
        }

        $availabilityAbstractEntity = SpyAvailabilityAbstractQuery::create()
            ->filterByAbstractSku($abstractSku)
            ->filterByFkStore($idStore)
            ->findOne();

        if (!$availabilityAbstractEntity) {
            $availabilityAbstractEntity = $this->createAvailabilityAbstract($abstractSku, $idStore);
        }

        static::$availabilityAbstractEntitiesIndexedByAbstractSkuAndIdStore[$abstractSku][$idStore] = $availabilityAbstractEntity;

        return $availabilityAbstractEntity;
    }

    protected function createAvailabilityAbstract(string $abstractSku, int $idStore): SpyAvailabilityAbstract
    {
        $availableAbstractEntity = (new SpyAvailabilityAbstract())
            ->setAbstractSku($abstractSku)
            ->setFkStore($idStore);

        $availableAbstractEntity->save();

        return $availableAbstractEntity;
    }

    protected function updateAbstractAvailabilityQuantity(
        SpyAvailabilityAbstract $availabilityAbstractEntity,
        int $idStore,
    ): SpyAvailabilityAbstract {
        $sumQuantity = SpyAvailabilityQuery::create()
            ->filterByFkAvailabilityAbstract($availabilityAbstractEntity->getIdAvailabilityAbstract())
            ->filterByFkStore($idStore)
            ->withColumn(sprintf('SUM(%s)', SpyAvailabilityTableMap::COL_QUANTITY), static::COL_AVAILABILITY_TOTAL_QUANTITY)
            ->select([static::COL_AVAILABILITY_TOTAL_QUANTITY])
            ->findOne();

        $availabilityAbstractEntity->setFkStore($idStore);
        $availabilityAbstractEntity->setQuantity((string)$sumQuantity);
        $availabilityAbstractEntity->save();

        return $availabilityAbstractEntity;
    }
}
