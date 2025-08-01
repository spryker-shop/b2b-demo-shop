<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\Product\Repository;

use Generated\Shared\Transfer\PaginationTransfer;
use Orm\Zed\Product\Persistence\SpyProduct;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Propel\Runtime\Collection\ArrayCollection;

interface ProductRepositoryInterface
{
    /**
     * @param string $sku
     *
     * @return int
     */
    public function getIdProductByConcreteSku(string $sku): int;

    /**
     * @param string $sku
     *
     * @return string
     */
    public function getAbstractSkuByConcreteSku(string $sku): string;

    /**
     * @return array<string>
     */
    public function getSkuProductAbstractList(): array;

    /**
     * @return array<string>
     */
    public function getSkuProductConcreteList(): array;

    /**
     * @param string $sku
     *
     * @return int
     */
    public function getIdProductAbstractByAbstractSku(string $sku): int;

    /**
     * @param \Generated\Shared\Transfer\PaginationTransfer $paginationTransfer
     *
     * @return \Propel\Runtime\Collection\ArrayCollection
     */
    public function getProductConcreteAttributesCollection(PaginationTransfer $paginationTransfer): ArrayCollection;

    /**
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract $productAbstractEntity
     *
     * @return void
     */
    public function addProductAbstract(SpyProductAbstract $productAbstractEntity): void;

    /**
     * @param \Orm\Zed\Product\Persistence\SpyProduct $productEntity
     * @param string|null $abstractSku
     *
     * @return void
     */
    public function addProductConcrete(SpyProduct $productEntity, ?string $abstractSku = null): void;

    /**
     * @return void
     */
    public function flush(): void;
}
