<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Zed\PropelOrm\Stub;

use Exception;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes;
use Spryker\Zed\Product\Persistence\ProductQueryContainerInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\DatabaseTransactionHandlerTrait;

class ProductManagerStub
{
    use DatabaseTransactionHandlerTrait;

    protected ProductQueryContainerInterface $productQueryContainer;

    public function __construct(ProductQueryContainerInterface $productQueryContainer)
    {
        $this->productQueryContainer = $productQueryContainer;
    }

    protected function createProductAbstractEntity(string $sku): SpyProductAbstract
    {
        $productAbstractEntity = new SpyProductAbstract();
        $productAbstractEntity->setSku($sku);
        $productAbstractEntity->setAttributes('{}');
        $productAbstractEntity->save();

        return $productAbstractEntity;
    }

    protected function createLocalizedAttributeEntity(string $name, int $idProductAbstract): SpyProductAbstractLocalizedAttributes
    {
        $localizedAttributeEntity = new SpyProductAbstractLocalizedAttributes();
        $localizedAttributeEntity->setAttributes('{}');
        $localizedAttributeEntity->setFkLocale(66);
        $localizedAttributeEntity->setName($name);
        $localizedAttributeEntity->setFkProductAbstract($idProductAbstract);
        $localizedAttributeEntity->save();

        return $localizedAttributeEntity;
    }

    public function addProductWithoutTransactionHandling(string $sku, string $name): int
    {
        $this->productQueryContainer->getConnection()->beginTransaction();

        $productAbstractEntity = $this->createProductAbstractEntity($sku);
        $this->createLocalizedAttributeEntity($name, $productAbstractEntity->getIdProductAbstract());

        $this->productQueryContainer->getConnection()->commit();

        return $productAbstractEntity->getIdProductAbstract();
    }

    public function addProductWithoutTransactionHandlingShouldThrowException(string $sku, string $name): void
    {
        $this->productQueryContainer->getConnection()->beginTransaction();

        $productAbstractEntity = new SpyProductAbstract();
        $productAbstractEntity->setSku($sku);
        $productAbstractEntity->setAttributes('{}');
        $productAbstractEntity->save();

        $this->throwSampleException();

        $localizedAttributeEntity = new SpyProductAbstractLocalizedAttributes();
        $localizedAttributeEntity->setAttributes('{}');
        $localizedAttributeEntity->setFkLocale(66);
        $localizedAttributeEntity->setName($name);
        $localizedAttributeEntity->setFkProductAbstract($productAbstractEntity->getIdProductAbstract());
        $localizedAttributeEntity->save();

        $this->productQueryContainer->getConnection()->commit();
    }

    public function addProductWithTransactionHandlingShouldRollbackAndThrowException(string $sku, string $name): void
    {
        $this->handleDatabaseTransaction(function () use ($sku, $name): void {
            $productAbstractEntity = new SpyProductAbstract();
            $productAbstractEntity->setSku($sku);
            $productAbstractEntity->setAttributes('{}');
            $productAbstractEntity->save();

            $localizedAttributeEntity = new SpyProductAbstractLocalizedAttributes();
            $localizedAttributeEntity->setAttributes('{}');
            $localizedAttributeEntity->setFkLocale(66);
            $localizedAttributeEntity->setName($name);
            $localizedAttributeEntity->setFkProductAbstract($productAbstractEntity->getIdProductAbstract());
            $localizedAttributeEntity->save();

            $this->throwSampleException();
        }, $this->productQueryContainer->getConnection());
    }

    public function addProductWithTransactionHandlingShouldCommitAndReturnValue(string $sku, string $name): SpyProductAbstractLocalizedAttributes
    {
        return $this->handleDatabaseTransaction(function () use ($sku, $name) {
            $productAbstractEntity = new SpyProductAbstract();
            $productAbstractEntity->setSku($sku);
            $productAbstractEntity->setAttributes('{}');
            $productAbstractEntity->save();

            $localizedAttributeEntity = new SpyProductAbstractLocalizedAttributes();
            $localizedAttributeEntity->setAttributes('{}');
            $localizedAttributeEntity->setFkLocale(66);
            $localizedAttributeEntity->setName($name);
            $localizedAttributeEntity->setFkProductAbstract($productAbstractEntity->getIdProductAbstract());
            $localizedAttributeEntity->save();

            return $localizedAttributeEntity;
        }, $this->productQueryContainer->getConnection());
    }

    /**
     * @throws \Exception
     */
    protected function throwSampleException(): void
    {
        throw new Exception('DB error occured');
    }
}
