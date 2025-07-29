<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\CartReorder\RestApi\Fixtures;

use Generated\Shared\DataBuilder\ItemBuilder;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\ProductMeasurementSalesUnitTransfer;
use Generated\Shared\Transfer\ProductPackagingUnitTransfer;
use Generated\Shared\Transfer\ProductPackagingUnitTypeTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\SpyProductPackagingUnitEntityTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use PyzTest\Glue\CartReorder\CartReorderApiTester;
use SprykerTest\Shared\Testify\Fixtures\FixturesBuilderInterface;
use SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface;

class SalesUnitCartReorderRestApiFixtures implements FixturesBuilderInterface, FixturesContainerInterface
{
    /**
     * @var string
     */
    protected const TEST_USERNAME = 'ProductPackagingUnitCartReorderRestApiFixtures';

    /**
     * @var string
     */
    protected const TEST_PRODUCT_PACKAGING_UNIT_TYPE = 'box';

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer
     */
    protected StoreTransfer $storeTransfer;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer
     */
    protected CustomerTransfer $customerTransfer;

    /**
     * @var \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    protected ProductConcreteTransfer $productConcreteTransfer;

    /**
     * @var \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    protected ProductConcreteTransfer $productConcreteTransferWithSalesUnit;

    /**
     * @var \Generated\Shared\Transfer\ProductMeasurementSalesUnitTransfer
     */
    protected ProductMeasurementSalesUnitTransfer $productMeasurementSalesUnitTransfer;

    protected ProductPackagingUnitTransfer $productPackagingUnitTransfer;

    /**
     * @var \Generated\Shared\Transfer\SaveOrderTransfer
     */
    protected SaveOrderTransfer $orderWithSalesUnit;

    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function getCustomerTransfer(): CustomerTransfer
    {
        return $this->customerTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    public function getProductConcreteTransfer(): ProductConcreteTransfer
    {
        return $this->productConcreteTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    public function getProductConcreteTransferWithSalesUnit(): ProductConcreteTransfer
    {
        return $this->productConcreteTransferWithSalesUnit;
    }

    /**
     * @return \Generated\Shared\Transfer\ProductMeasurementSalesUnitTransfer
     */
    public function getProductMeasurementSalesUnitTransfer(): ProductMeasurementSalesUnitTransfer
    {
        return $this->productMeasurementSalesUnitTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\ProductPackagingUnitTransfer
     */
    public function getProductPackagingUnitTransfer(): ProductPackagingUnitTransfer
    {
        return $this->productPackagingUnitTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\SaveOrderTransfer
     */
    public function getOrderWithSalesUnit(): SaveOrderTransfer
    {
        return $this->orderWithSalesUnit;
    }

    /**
     * @param \PyzTest\Glue\CartReorder\CartReorderApiTester $I
     *
     * @return \SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface
     */
    public function buildFixtures(CartReorderApiTester $I): FixturesContainerInterface
    {
        $I->configureStateMachine();
        $this->storeTransfer = $I->getCurrentStore();
        $this->customerTransfer = $I->createCustomer(static::TEST_USERNAME);

        $this->productConcreteTransfer = $I->createProductWithPriceAndStock($this->storeTransfer);
        $this->productConcreteTransferWithSalesUnit = $I->createProductWithPriceAndStock($this->storeTransfer);
        $this->productMeasurementSalesUnitTransfer = $I->createProductMeasurementSalesUnit($this->productConcreteTransferWithSalesUnit);
        $this->productPackagingUnitTransfer = $this->createProductPackagingUnit($I);

        $this->orderWithSalesUnit = $this->createOrderWithProductPackagingUnit($I);

        return $this;
    }

    /**
     * @param \PyzTest\Glue\CartReorder\CartReorderApiTester $I
     *
     * @return \Generated\Shared\Transfer\ProductPackagingUnitTransfer
     */
    protected function createProductPackagingUnit(CartReorderApiTester $I): ProductPackagingUnitTransfer
    {
        $productPackagingUnitTypeTransfer = $I->haveProductPackagingUnitType([
            ProductPackagingUnitTypeTransfer::NAME => static::TEST_PRODUCT_PACKAGING_UNIT_TYPE,
        ]);

        $productPackagingUnitEntityTransfer = $I->haveProductPackagingUnit([
            SpyProductPackagingUnitEntityTransfer::FK_PRODUCT => $this->productConcreteTransferWithSalesUnit->getIdProductConcreteOrFail(),
            SpyProductPackagingUnitEntityTransfer::FK_PRODUCT_PACKAGING_UNIT_TYPE => $productPackagingUnitTypeTransfer->getIdProductPackagingUnitTypeOrFail(),
            SpyProductPackagingUnitEntityTransfer::FK_LEAD_PRODUCT => $this->productConcreteTransferWithSalesUnit->getIdProductConcreteOrFail(),
        ]);

        return (new ProductPackagingUnitTransfer())->fromArray($productPackagingUnitEntityTransfer->toArray(), true);
    }

    /**
     * @param \PyzTest\Glue\CartReorder\CartReorderApiTester $I
     *
     * @return \Generated\Shared\Transfer\SaveOrderTransfer
     */
    protected function createOrderWithProductPackagingUnit(CartReorderApiTester $I): SaveOrderTransfer
    {
        $itemsData = [
            (new ItemBuilder([
                ItemTransfer::SKU => $this->productConcreteTransfer->getSkuOrFail(),
                ItemTransfer::QUANTITY => 1,
            ]))->build()->toArray(),
            (new ItemBuilder([
                ItemTransfer::ID => $this->productConcreteTransferWithSalesUnit->getIdProductConcreteOrFail(),
                ItemTransfer::SKU => $this->productConcreteTransferWithSalesUnit->getSkuOrFail(),
                ItemTransfer::AMOUNT_SALES_UNIT => $this->productMeasurementSalesUnitTransfer,
                ItemTransfer::QUANTITY_SALES_UNIT => $this->productMeasurementSalesUnitTransfer,
                ItemTransfer::AMOUNT_LEAD_PRODUCT => $this->productConcreteTransferWithSalesUnit->toArray(),
                ItemTransfer::QUANTITY => 2,
                ItemTransfer::AMOUNT => 3,
            ]))->build()->toArray(),
        ];

        return $I->createOrder($this->customerTransfer, [QuoteTransfer::ITEMS => $itemsData]);
    }
}
