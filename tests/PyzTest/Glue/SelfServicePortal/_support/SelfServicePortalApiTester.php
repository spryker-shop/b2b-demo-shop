<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\SelfServicePortal;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MoneyValueTransfer;
use Generated\Shared\Transfer\PriceProductTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\StockProductTransfer;
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
class SelfServicePortalApiTester extends ApiEndToEndTester
{
    use _generated\SelfServicePortalApiTesterActions;

    public function authorizeCustomerToGlue(CustomerTransfer $customerTransfer): void
    {
        $oauthResponseTransfer = $this->haveAuthorizationToGlue($customerTransfer);
        $this->amBearerAuthenticated($oauthResponseTransfer->getAccessToken());
    }

    public function getSspAssetsUrl(): string
    {
        return $this->formatUrl('ssp-assets');
    }

    public function getSspAssetUrl(string $assetId): string
    {
        return $this->formatUrl('ssp-assets/{assetId}', ['assetId' => $assetId]);
    }

    public function assertResponseMatchAssetReference(string $assetReference): void
    {
        $attributes = $this->getDataFromResponseByJsonPath('$.data[0].attributes');

        $this->assertArrayHasKey('reference', $attributes);
        $this->assertSame($assetReference, $attributes['reference']);
    }

    public function getSspInquiriesUrl(): string
    {
        return $this->formatUrl('ssp-inquiries');
    }

    public function getSspInquiryUrl(string $inquiryId): string
    {
        return $this->formatUrl('ssp-inquiries/{inquiryId}', ['inquiryId' => $inquiryId]);
    }

    public function assertResponseMatchInquiryReference(string $inquiryReference): void
    {
        $attributes = $this->getDataFromResponseByJsonPath('$.data.attributes');

        $this->assertArrayHasKey('reference', $attributes);
        $this->assertSame($inquiryReference, $attributes['reference']);
    }

    public function assertResponseMatchAssetReferenceAttachedToInquiry(string $assetReference): void
    {
        $attributes = $this->getDataFromResponseByJsonPath('$.data.attributes');

        $this->assertArrayHasKey('sspAssetReference', $attributes);
        $this->assertSame($assetReference, $attributes['sspAssetReference']);
    }

    public function assertResponseMatchOrderReferenceAttachedToInquiry(string $orderReference): void
    {
        $attributes = $this->getDataFromResponseByJsonPath('$.data.attributes');

        $this->assertArrayHasKey('orderReference', $attributes);
        $this->assertSame($orderReference, $attributes['orderReference']);
    }

    public function haveProductWithPriceAndStock(?int $unitPrice = 10000): ProductConcreteTransfer
    {
        $storeTransfer = $this->getLocator()->store()->facade()->getCurrentStore();
        $productConcreteTransfer = $this->haveFullProduct();

        $this->haveProductInStockForStore($storeTransfer, [
            StockProductTransfer::SKU => $productConcreteTransfer->getSku(),
            StockProductTransfer::IS_NEVER_OUT_OF_STOCK => 1,
        ]);

        $priceProductTransfer = $this->havePriceProduct([
            PriceProductTransfer::SKU_PRODUCT_ABSTRACT => $productConcreteTransfer->getAbstractSku(),
            PriceProductTransfer::SKU_PRODUCT => $productConcreteTransfer->getSku(),
            PriceProductTransfer::ID_PRODUCT => $productConcreteTransfer->getIdProductConcrete(),
            PriceProductTransfer::PRICE_TYPE_NAME => 'DEFAULT',
            PriceProductTransfer::MONEY_VALUE => [
                MoneyValueTransfer::NET_AMOUNT => $unitPrice,
                MoneyValueTransfer::GROSS_AMOUNT => $unitPrice,
            ],
        ]);

        $productConcreteTransfer->addPrice($priceProductTransfer);

        return $productConcreteTransfer;
    }

    public function getSspServicesUrl(): string
    {
        return $this->formatUrl('booked-services');
    }

    public function assertNumberOfResources(int $expectedQuantity): void
    {
        $this->assertSame($expectedQuantity, count($this->getDataFromResponseByJsonPath('$.data[*]')));
    }
}
