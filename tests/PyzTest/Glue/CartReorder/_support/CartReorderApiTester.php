<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\CartReorder;

use Generated\Shared\DataBuilder\QuoteBuilder;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MoneyValueTransfer;
use Generated\Shared\Transfer\PriceProductTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\ProductMeasurementBaseUnitTransfer;
use Generated\Shared\Transfer\ProductMeasurementSalesUnitTransfer;
use Generated\Shared\Transfer\ProductMeasurementUnitTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestCartItemsSalesUnitAttributesTransfer;
use Generated\Shared\Transfer\RestCartsAttributesTransfer;
use Generated\Shared\Transfer\RestItemProductOptionsTransfer;
use Generated\Shared\Transfer\RestItemsAttributesTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\StockProductTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\DecimalObject\Decimal;
use Spryker\Glue\CartReorderRestApi\CartReorderRestApiConfig;
use Spryker\Glue\CartsRestApi\CartsRestApiConfig;
use SprykerTest\Glue\Testify\Tester\ApiEndToEndTester;

/**
 * Inherited Methods
 *
 * @method void wantTo($text)
 * @method void wantToTest($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause($vars = [])
 *
 * @SuppressWarnings(PHPMD)
 */
class CartReorderApiTester extends ApiEndToEndTester
{
    use _generated\CartReorderApiTesterActions;

    /**
     * @uses \Spryker\Glue\CartsRestApi\CartsRestApiConfig::RESOURCE_CART_ITEMS
     *
     * @var string
     */
    public const RESOURCE_CARTS = 'carts';

    /**
     * @uses \Spryker\Glue\CartsRestApi\CartsRestApiConfig::RESOURCE_CART_ITEMS
     *
     * @var string
     */
    public const RESOURCE_CART_ITEMS = 'items';

    /**
     * @uses \Spryker\Glue\ProductBundleCartsRestApi\ProductBundleCartsRestApiConfig::RESOURCE_BUNDLE_ITEMS
     *
     * @var string
     */
    public const RESOURCE_BUNDLE_ITEMS = 'bundle-items';

    /**
     * @uses \Spryker\Shared\PriceProduct\PriceProductConfig::PRICE_TYPE_DEFAULT
     *
     * @var string
     */
    public const PRICE_TYPE = 'DEFAULT';

    /**
     * @var string
     */
    protected const PRICE_MODE = 'GROSS_MODE';

    /**
     * @var string
     */
    protected const STATE_MACHINE_NAME = 'DummyPayment01';

    /**
     * @var string
     */
    protected const TEST_CUSTOMER_PASSWORD = 'change123';

    /**
     * @return void
     */
    public function configureStateMachine(): void
    {
        $this->configureTestStateMachine([static::STATE_MACHINE_NAME]);
    }

    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer
    {
        return $this->getLocator()->store()->facade()->getCurrentStore();
    }

    /**
     * @param string $customerName
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function createCustomer(string $customerName): CustomerTransfer
    {
        $customerTransfer = $this->haveCustomer([
            CustomerTransfer::USERNAME => $customerName,
            CustomerTransfer::PASSWORD => static::TEST_CUSTOMER_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_CUSTOMER_PASSWORD,
        ]);

        return $this->confirmCustomer($customerTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    public function createProductWithPriceAndStock(StoreTransfer $storeTransfer): ProductConcreteTransfer
    {
        $productConcreteTransfer = $this->haveFullProduct();

        $this->haveProductInStockForStore($storeTransfer, [
            StockProductTransfer::SKU => $productConcreteTransfer->getSku(),
            StockProductTransfer::IS_NEVER_OUT_OF_STOCK => 1,
        ]);

        $this->havePriceProduct([
            PriceProductTransfer::SKU_PRODUCT_ABSTRACT => $productConcreteTransfer->getAbstractSkuOrFail(),
            PriceProductTransfer::SKU_PRODUCT => $productConcreteTransfer->getSkuOrFail(),
            PriceProductTransfer::ID_PRODUCT => $productConcreteTransfer->getIdProductConcreteOrFail(),
            PriceProductTransfer::PRICE_TYPE_NAME => static::PRICE_TYPE,
            PriceProductTransfer::MONEY_VALUE => [
                MoneyValueTransfer::NET_AMOUNT => 777,
                MoneyValueTransfer::GROSS_AMOUNT => 888,
            ],
        ]);

        return $productConcreteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\ProductMeasurementSalesUnitTransfer
     */
    public function createProductMeasurementSalesUnit(ProductConcreteTransfer $productConcreteTransfer): ProductMeasurementSalesUnitTransfer
    {
        $productMeasurementUnitEntityTransfer = $this->haveProductMeasurementUnit();
        $productMeasurementUnitTransfer = (new ProductMeasurementUnitTransfer())->fromArray(
            $productMeasurementUnitEntityTransfer->toArray(),
            true,
        );

        $productMeasurementBaseUnitEntityTransfer = $this->haveProductMeasurementBaseUnit(
            $productConcreteTransfer->getFkProductAbstractOrFail(),
            $productMeasurementUnitEntityTransfer->getIdProductMeasurementUnitOrFail(),
        );
        $productMeasurementBaseUnitTransfer = (new ProductMeasurementBaseUnitTransfer())->fromArray(
            $productMeasurementBaseUnitEntityTransfer->toArray(),
            true,
        )->setProductMeasurementUnit($productMeasurementUnitTransfer);

        $productMeasurementSalesUnitEntityTransfer = $this->haveProductMeasurementSalesUnit(
            $productConcreteTransfer->getIdProductConcreteOrFail(),
            $productMeasurementUnitEntityTransfer->getIdProductMeasurementUnitOrFail(),
            $productMeasurementBaseUnitEntityTransfer->getIdProductMeasurementBaseUnitOrFail(),
        );

        return (new ProductMeasurementSalesUnitTransfer())
            ->fromArray($productMeasurementSalesUnitEntityTransfer->toArray(), true)
            ->setProductMeasurementUnit($productMeasurementUnitTransfer)
            ->setProductMeasurementBaseUnit($productMeasurementBaseUnitTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param array<string, mixed> $seedData
     * @param list<\Spryker\Zed\CheckoutExtension\Dependency\Plugin\CheckoutDoSaveOrderInterface> $checkoutDoSaveOrderPlugins
     *
     * @return \Generated\Shared\Transfer\SaveOrderTransfer
     */
    public function createOrder(
        CustomerTransfer $customerTransfer,
        array $seedData,
        array $checkoutDoSaveOrderPlugins = [],
    ): SaveOrderTransfer {
        $quoteTransfer = $this->createQuoteTransfer($customerTransfer, $seedData);
        $quoteTransfer->setPriceMode(static::PRICE_MODE);

        return $this->haveOrderFromQuote(
            $quoteTransfer,
            static::STATE_MACHINE_NAME,
            $checkoutDoSaveOrderPlugins,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function authorizeCustomerToGlue(CustomerTransfer $customerTransfer): void
    {
        $oauthResponseTransfer = $this->haveAuthorizationToGlue($customerTransfer);
        $this->amBearerAuthenticated($oauthResponseTransfer->getAccessToken());
    }

    /**
     * @return string
     */
    public function getCartReorderUrl(): string
    {
        $url = sprintf('{cartReorderResource}?include=%s,%s', static::RESOURCE_CART_ITEMS, static::RESOURCE_BUNDLE_ITEMS);

        return $this->formatUrl($url, [
            'cartReorderResource' => CartReorderRestApiConfig::RESOURCE_CART_REORDER,
        ]);
    }

    /**
     * @param string $quoteName
     *
     * @return void
     */
    public function assertResponseContainsCorrectCartName(string $quoteName): void
    {
        $attributes = $this->getDataFromResponseByJsonPath('$.data.attributes');

        $this->assertArrayHasKey(RestCartsAttributesTransfer::NAME, $attributes);
        $this->assertSame($quoteName, $attributes[RestCartsAttributesTransfer::NAME]);
    }

    /**
     * @param string $sku
     *
     * @return void
     */
    public function assertResponseContainsItemBySku(string $sku): void
    {
        $this->assertNotNull($this->findIncludedItemsResourceBySku($sku));
    }

    /**
     * @param string $sku
     *
     * @return void
     */
    public function assertResponseDoesNotContainItemBySku(string $sku): void
    {
        $this->assertNull($this->findIncludedItemsResourceBySku($sku));
    }

    /**
     * @param string $sku
     *
     * @return void
     */
    public function assertResponseContainsBundleItemBySku(string $sku): void
    {
        $this->assertNotNull($this->findIncludedBundleItemsResourceBySku($sku));
    }

    /**
     * @param string $sku
     * @param int $quantity
     *
     * @return void
     */
    public function assertItemHasCorrectQuantity(string $sku, int $quantity): void
    {
        $itemsResourceAttributes = $this->findIncludedItemsResourceBySku($sku)['attributes'];

        $this->assertArrayHasKey(RestItemsAttributesTransfer::QUANTITY, $itemsResourceAttributes);
        $this->assertSame($quantity, $itemsResourceAttributes[RestItemsAttributesTransfer::QUANTITY]);
    }

    /**
     * @param string $sku
     * @param int $quantity
     *
     * @return void
     */
    public function assertBundleItemHasCorrectQuantity(string $sku, int $quantity): void
    {
        $bundleItemsResourceAttributes = $this->findIncludedBundleItemsResourceBySku($sku)['attributes'];

        $this->assertArrayHasKey(RestItemsAttributesTransfer::QUANTITY, $bundleItemsResourceAttributes);
        $this->assertSame($quantity, $bundleItemsResourceAttributes[RestItemsAttributesTransfer::QUANTITY]);
    }

    /**
     * @param string $sku
     * @param int $idSalesUnit
     *
     * @return void
     */
    public function assertItemHasIdSalesUnit(string $sku, int $idSalesUnit): void
    {
        $itemsResourceAttributes = $this->findIncludedItemsResourceBySku($sku)['attributes'];

        $this->assertArrayHasKey(RestItemsAttributesTransfer::SALES_UNIT, $itemsResourceAttributes);
        $itemSalesUnitData = $itemsResourceAttributes[RestItemsAttributesTransfer::SALES_UNIT];
        $this->assertArrayHasKey(RestCartItemsSalesUnitAttributesTransfer::ID, $itemSalesUnitData);
        $this->assertSame($idSalesUnit, $itemSalesUnitData[RestCartItemsSalesUnitAttributesTransfer::ID]);
    }

    /**
     * @param string $sku
     * @param \Spryker\DecimalObject\Decimal $amount
     *
     * @return void
     */
    public function assertItemHasSalesUnitAmount(string $sku, Decimal $amount): void
    {
        $itemsResourceAttributes = $this->findIncludedItemsResourceBySku($sku)['attributes'];

        $this->assertArrayHasKey(RestItemsAttributesTransfer::SALES_UNIT, $itemsResourceAttributes);
        $itemSalesUnitData = $itemsResourceAttributes[RestItemsAttributesTransfer::SALES_UNIT];
        $this->assertArrayHasKey(RestCartItemsSalesUnitAttributesTransfer::AMOUNT, $itemSalesUnitData);
        $this->assertTrue($amount->equals($itemSalesUnitData[RestCartItemsSalesUnitAttributesTransfer::AMOUNT]));
    }

    /**
     * @param string $productConcreteSku
     * @param string $productOptionSku
     *
     * @return void
     */
    public function assertItemHasProductOption(string $productConcreteSku, string $productOptionSku): void
    {
        $itemsResourceAttributes = $this->findIncludedItemsResourceBySku($productConcreteSku)['attributes'];

        $this->assertArrayHasKey(RestItemsAttributesTransfer::SELECTED_PRODUCT_OPTIONS, $itemsResourceAttributes);
        $this->assertCount(1, $itemsResourceAttributes[RestItemsAttributesTransfer::SELECTED_PRODUCT_OPTIONS]);

        $productOption = $itemsResourceAttributes[RestItemsAttributesTransfer::SELECTED_PRODUCT_OPTIONS][0];

        $this->assertArrayHasKey(RestItemProductOptionsTransfer::SKU, $productOption);
        $this->assertSame($productOptionSku, $productOption[RestItemProductOptionsTransfer::SKU]);
    }

    /**
     * @param string $cartUuid
     *
     * @return string
     */
    public function buildCartsUrl(string $cartUuid): string
    {
        return $this->formatFullUrl(
            '{resourceCarts}/{cartUuid}',
            [
                'resourceCarts' => CartsRestApiConfig::RESOURCE_CARTS,
                'cartUuid' => $cartUuid,
            ],
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param array<string, mixed> $seedData
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function createQuoteTransfer(CustomerTransfer $customerTransfer, array $seedData): QuoteTransfer
    {
        return (new QuoteBuilder($seedData))
            ->withCustomer([CustomerTransfer::CUSTOMER_REFERENCE => $customerTransfer->getCustomerReference()])
            ->withTotals()
            ->withShippingAddress()
            ->withBillingAddress()
            ->withCurrency()
            ->withPayment()
            ->build();
    }

    /**
     * @param string $sku
     *
     * @return array<string, mixed>|null
     */
    protected function findIncludedItemsResourceBySku(string $sku): ?array
    {
        $jsonPath = sprintf(
            '$..included[?(@.type == \'%s\')]',
            static::RESOURCE_CART_ITEMS,
        );

        $itemsResources = $this->getDataFromResponseByJsonPath($jsonPath);
        foreach ($itemsResources as $itemsResource) {
            if ($itemsResource['attributes']['sku'] === $sku) {
                return $itemsResource;
            }
        }

        return null;
    }

    /**
     * @param string $sku
     *
     * @return array<string, mixed>|null
     */
    protected function findIncludedBundleItemsResourceBySku(string $sku): ?array
    {
        $jsonPath = sprintf(
            '$..included[?(@.type == \'%s\')]',
            static::RESOURCE_BUNDLE_ITEMS,
        );

        $bundleItemsResources = $this->getDataFromResponseByJsonPath($jsonPath);
        foreach ($bundleItemsResources as $bundleItemsResource) {
            if ($bundleItemsResource['attributes']['sku'] === $sku) {
                return $bundleItemsResource;
            }
        }

        return null;
    }
}
