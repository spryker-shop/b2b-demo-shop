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

    protected StoreTransfer $storeTransfer;

    protected CustomerTransfer $customerTransfer;

    protected ProductConcreteTransfer $productConcreteTransfer;

    protected ProductConcreteTransfer $productConcreteTransferWithSalesUnit;

    protected ProductMeasurementSalesUnitTransfer $productMeasurementSalesUnitTransfer;

    protected ProductPackagingUnitTransfer $productPackagingUnitTransfer;

    protected SaveOrderTransfer $orderWithSalesUnit;

    public function getCustomerTransfer(): CustomerTransfer
    {
        return $this->customerTransfer;
    }

    public function getProductConcreteTransfer(): ProductConcreteTransfer
    {
        return $this->productConcreteTransfer;
    }

    public function getProductConcreteTransferWithSalesUnit(): ProductConcreteTransfer
    {
        return $this->productConcreteTransferWithSalesUnit;
    }

    public function getProductMeasurementSalesUnitTransfer(): ProductMeasurementSalesUnitTransfer
    {
        return $this->productMeasurementSalesUnitTransfer;
    }

    public function getProductPackagingUnitTransfer(): ProductPackagingUnitTransfer
    {
        return $this->productPackagingUnitTransfer;
    }

    public function getOrderWithSalesUnit(): SaveOrderTransfer
    {
        return $this->orderWithSalesUnit;
    }

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
