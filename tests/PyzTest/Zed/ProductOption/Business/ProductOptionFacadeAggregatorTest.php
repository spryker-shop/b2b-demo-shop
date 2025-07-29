<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Zed\ProductOption\Business;

use Codeception\Test\Unit;
use DateTime;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\ProductOptionTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Orm\Zed\Oms\Persistence\SpyOmsOrderItemState;
use Orm\Zed\Oms\Persistence\SpyOmsOrderProcess;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemOption;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery;
use Spryker\Zed\ProductOption\Business\ProductOptionFacade;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group ProductOption
 * @group Business
 * @group Facade
 * @group ProductOptionFacadeAggregatorTest
 * Add your own group annotations below this line
 */
class ProductOptionFacadeAggregatorTest extends Unit
{
    /**
     * @return void
     */
    public function testSaveSaleOrderProductOptionsShouldPersistProvidedOptions(): void
    {
        $productOptionFacade = $this->createProductOptionFacade();

        $orderTransfer = $this->createOrderTransferWithRelatedPersistedData(false);

        $quoteTransfer = new QuoteTransfer();
        $checkoutResponseTransfer = new CheckoutResponseTransfer();

        $orderSaverTransfer = new SaveOrderTransfer();
        $orderSaverTransfer->fromArray($orderTransfer->toArray(), true);
        $orderSaverTransfer->setOrderItems($orderTransfer->getItems());
        $checkoutResponseTransfer->setSaveOrder($orderSaverTransfer);

        $productOptionFacade->saveSaleOrderProductOptions($quoteTransfer, $checkoutResponseTransfer);

        $salesOrderItemOptionEntity = SpySalesOrderItemOptionQuery::create()
            ->findOneByFkSalesOrderItem($orderTransfer->getItems()[0]->getIdSalesOrderItem());

        $productOptionTransfer = $orderTransfer->getItems()[0]->getProductOptions()[0];

        $this->assertNotEmpty($salesOrderItemOptionEntity);
        $this->assertSame($salesOrderItemOptionEntity->getGrossPrice(), $productOptionTransfer->getSumGrossPrice());
    }

    /**
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddress
     */
    protected function createSalesOrderAddress(): SpySalesOrderAddress
    {
        $salesOrderAddressEntity = new SpySalesOrderAddress();
        $salesOrderAddressEntity->setAddress1(1);
        $salesOrderAddressEntity->setAddress2(2);
        $salesOrderAddressEntity->setSalutation('Mr');
        $salesOrderAddressEntity->setCellPhone('123456789');
        $salesOrderAddressEntity->setCity('City');
        $salesOrderAddressEntity->setCreatedAt(new DateTime());
        $salesOrderAddressEntity->setUpdatedAt(new DateTime());
        $salesOrderAddressEntity->setComment('Comment');
        $salesOrderAddressEntity->setDescription('Description');
        $salesOrderAddressEntity->setCompany('Company');
        $salesOrderAddressEntity->setFirstName('FirstName');
        $salesOrderAddressEntity->setLastName('LastName');
        $salesOrderAddressEntity->setFkCountry(1);
        $salesOrderAddressEntity->setEmail('Email');
        $salesOrderAddressEntity->setZipCode(12345);
        $salesOrderAddressEntity->save();

        return $salesOrderAddressEntity;
    }

    /**
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderProcess
     */
    protected function createOmsProcess(): SpyOmsOrderProcess
    {
        $omsProcessEntity = new SpyOmsOrderProcess();
        $omsProcessEntity->setName('test');
        $omsProcessEntity->save();

        return $omsProcessEntity;
    }

    /**
     * @return \Orm\Zed\Oms\Persistence\SpyOmsOrderItemState
     */
    protected function createOmsState(): SpyOmsOrderItemState
    {
        $omsStateEntity = new SpyOmsOrderItemState();
        $omsStateEntity->setName('test');
        $omsStateEntity->save();

        return $omsStateEntity;
    }

    /**
     * @return \Spryker\Zed\ProductOption\Business\ProductOptionFacade
     */
    protected function createProductOptionFacade(): ProductOptionFacade
    {
        return new ProductOptionFacade();
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress $address1
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress $address2
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrder
     */
    protected function createSalesOrderEntity(SpySalesOrderAddress $address1, SpySalesOrderAddress $address2): SpySalesOrder
    {
        $salesOrderEntity = new SpySalesOrder();
        $salesOrderEntity->setFkSalesOrderAddressBilling($address1->getIdSalesOrderAddress());
        $salesOrderEntity->setFkSalesOrderAddressShipping($address2->getIdSalesOrderAddress());
        $salesOrderEntity->setFirstName('First');
        $salesOrderEntity->setLastName('Last');
        $salesOrderEntity->setEmail('email@email.tld');
        $salesOrderEntity->setOrderReference('order reference');
        $salesOrderEntity->save();

        return $salesOrderEntity;
    }

    /**
     * @param \Orm\Zed\Oms\Persistence\SpyOmsOrderItemState $testStateEntity
     * @param \Orm\Zed\Oms\Persistence\SpyOmsOrderProcess $omsProcessEntity
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItem
     */
    protected function createSalesOrderItemEntity(
        SpyOmsOrderItemState $testStateEntity,
        SpyOmsOrderProcess $omsProcessEntity,
        SpySalesOrder $salesOrderEntity,
    ): SpySalesOrderItem {
        $salesOrderItemEntity = new SpySalesOrderItem();
        $salesOrderItemEntity->setFkOmsOrderItemState($testStateEntity->getIdOmsOrderItemState());
        $salesOrderItemEntity->setFkOmsOrderProcess($omsProcessEntity->getIdOmsOrderProcess());
        $salesOrderItemEntity->setFkSalesOrder($salesOrderEntity->getIdSalesOrder());
        $salesOrderItemEntity->setGrossPrice(1500);
        $salesOrderItemEntity->setQuantity(2);
        $salesOrderItemEntity->setSku('sku-123-321');
        $salesOrderItemEntity->setName('name-of-order-item');
        $salesOrderItemEntity->setTaxRate(19);
        $salesOrderItemEntity->setLastStateChange(new DateTime());
        $salesOrderItemEntity->save();

        return $salesOrderItemEntity;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $salesOrderItemEntity
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemOption
     */
    protected function createSalesOrderItemOptionEntity(SpySalesOrderItem $salesOrderItemEntity): SpySalesOrderItemOption
    {
        $salesOrderItemOptionEntity = new SpySalesOrderItemOption();
        $salesOrderItemOptionEntity->setFkSalesOrderItem($salesOrderItemEntity->getIdSalesOrderItem());
        $salesOrderItemOptionEntity->setGrossPrice(100);
        $salesOrderItemOptionEntity->setGroupName('group');
        $salesOrderItemOptionEntity->setValue('value');
        $salesOrderItemOptionEntity->setTaxRate(19);
        $salesOrderItemOptionEntity->setSku('123');
        $salesOrderItemOptionEntity->save();

        return $salesOrderItemOptionEntity;
    }

    /**
     * @param bool $createOptions
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    protected function createOrderTransferWithRelatedPersistedData(bool $createOptions = true): OrderTransfer
    {
        $address1 = $this->createSalesOrderAddress();
        $address2 = $this->createSalesOrderAddress();

        $salesOrderEntity = $this->createSalesOrderEntity($address1, $address2);

        $omsProcessEntity = $this->createOmsProcess();
        $testStateEntity = $this->createOmsState();

        $salesOrderItemEntity = $this->createSalesOrderItemEntity($testStateEntity, $omsProcessEntity, $salesOrderEntity);

        $itemTransfer = new ItemTransfer();
        $itemTransfer->setIdSalesOrderItem($salesOrderItemEntity->getIdSalesOrderItem());

        $productOptionTransfer = new ProductOptionTransfer();
        $productOptionTransfer->setSumGrossPrice(200);
        $productOptionTransfer->setValue('value');
        $productOptionTransfer->setGroupName('group name');
        $productOptionTransfer->setTaxRate(19);
        $productOptionTransfer->setSku('124');

        if ($createOptions) {
            $salesOrderItemOptionEntity = $this->createSalesOrderItemOptionEntity($salesOrderItemEntity);
            $productOptionTransfer->setIdSalesOrderItemOption($salesOrderItemOptionEntity->getIdSalesOrderItemOption());
        }

        $orderTransfer = new OrderTransfer();
        $orderTransfer->setIdSalesOrder($salesOrderEntity->getIdSalesOrder());

        $itemTransfer->addProductOption($productOptionTransfer);

        $orderTransfer->addItem($itemTransfer);

        return $orderTransfer;
    }
}
