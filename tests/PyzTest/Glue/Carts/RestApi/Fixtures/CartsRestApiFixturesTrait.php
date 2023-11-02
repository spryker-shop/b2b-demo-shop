<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\Carts\RestApi\Fixtures;

use Generated\Shared\Transfer\MoneyValueTransfer;
use Generated\Shared\Transfer\PriceProductTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\StockProductTransfer;
use PyzTest\Glue\Carts\CartsApiTester;
use Spryker\Zed\Store\Business\StoreFacadeInterface;

trait CartsRestApiFixturesTrait
{
    /**
     * @param \PyzTest\Glue\Carts\CartsApiTester $I
     *
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    protected function createProduct(CartsApiTester $I): ProductConcreteTransfer
    {
        $productConcreteTransfer = $I->haveFullProduct();

        $I->haveProductInStockForStore($this->getStoreFacade($I)->getCurrentStore(), [
            StockProductTransfer::SKU => $productConcreteTransfer->getSku(),
            StockProductTransfer::IS_NEVER_OUT_OF_STOCK => 1,
        ]);

        $priceProductOverride = [
            PriceProductTransfer::SKU_PRODUCT_ABSTRACT => $productConcreteTransfer->getAbstractSku(),
            PriceProductTransfer::SKU_PRODUCT => $productConcreteTransfer->getSku(),
            PriceProductTransfer::ID_PRODUCT => $productConcreteTransfer->getIdProductConcrete(),
            PriceProductTransfer::PRICE_TYPE_NAME => 'DEFAULT',
            PriceProductTransfer::MONEY_VALUE => [
                MoneyValueTransfer::NET_AMOUNT => 777,
                MoneyValueTransfer::GROSS_AMOUNT => 888,
            ],
        ];
        $I->havePriceProduct($priceProductOverride);

        return $productConcreteTransfer;
    }

    /**
     * @param \PyzTest\Glue\Carts\CartsApiTester $I
     *
     * @return \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected function getStoreFacade(CartsApiTester $I): StoreFacadeInterface
    {
        return $I->getLocator()->store()->facade();
    }
}
