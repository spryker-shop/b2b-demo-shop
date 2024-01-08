<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\Checkout\RestApi;

use Codeception\Util\HttpCode;
use PyzTest\Glue\Checkout\CheckoutApiTester;
use PyzTest\Glue\Checkout\RestApi\Fixtures\CompanyBusinessUnitAddressCheckoutRestApiFixtures;
use Spryker\Glue\CheckoutRestApi\CheckoutRestApiConfig;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group Checkout
 * @group RestApi
 * @group CompanyBusinessUnitAddressCheckoutRestApiCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class CompanyBusinessUnitAddressCheckoutRestApiCest
{
    /**
     * @var \PyzTest\Glue\Checkout\RestApi\Fixtures\CompanyBusinessUnitAddressCheckoutRestApiFixtures
     */
    protected CompanyBusinessUnitAddressCheckoutRestApiFixtures $fixtures;

    /**
     * @param \PyzTest\Glue\Checkout\CheckoutApiTester $I
     *
     * @return void
     */
    public function loadFixtures(CheckoutApiTester $I): void
    {
        $fixtures = $I->loadFixtures(CompanyBusinessUnitAddressCheckoutRestApiFixtures::class);
        $this->fixtures = $fixtures;
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\Checkout\CheckoutApiTester $I
     *
     * @return void
     */
    public function requestCheckoutShouldAcceptCompanyBusinessUnitAddressForBillingAddress(CheckoutApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());

        $quoteTransfer = $I->havePersistentQuoteWithItemsAndItemLevelShipment(
            $this->fixtures->getCustomerTransfer(),
            [$I->getQuoteItemOverrideData($I->haveProductWithStock(), $this->fixtures->getShipmentMethodTransfer(), 5)],
        );
        $quoteTransfer = $I->getCartFacade()->validateQuote($quoteTransfer)->getQuoteTransfer();

        $requestPayload = [
            'data' => [
                'type' => CheckoutRestApiConfig::RESOURCE_CHECKOUT,
                'attributes' => [
                    'idCart' => $quoteTransfer->getUuid(),
                    'billingAddress' => [
                        'idCompanyBusinessUnitAddress' => $this->fixtures->getCompanyUnitAddressTransfer()->getUuid(),
                    ],
                    'payments' => $I->getPaymentRequestPayload(),
                    'shipments' => [
                        $I->getSplitShipmentRequestPayload($quoteTransfer->getItems()->offsetGet(0)),
                    ],
                ],
            ],
        ];

        // Act
        $I->sendPOST($I->buildCheckoutUrl(['orders']), $requestPayload);

        // Assert
        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->assertCompanyBusinessUnitBillingAddressInOrders($this->fixtures->getCompanyUnitAddressTransfer());
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\Checkout\CheckoutApiTester $I
     *
     * @return void
     */
    public function requestCheckoutShouldAcceptCompanyBusinessUnitAddressForShippingAddress(CheckoutApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());

        $quoteTransfer = $I->havePersistentQuoteWithItemsAndItemLevelShipment(
            $this->fixtures->getCustomerTransfer(),
            [$I->getQuoteItemOverrideData($I->haveProductWithStock(), $this->fixtures->getShipmentMethodTransfer(), 5)],
        );
        $quoteTransfer = $I->getCartFacade()->validateQuote($quoteTransfer)->getQuoteTransfer();

        $requestPayload = [
            'data' => [
                'type' => CheckoutRestApiConfig::RESOURCE_CHECKOUT,
                'attributes' => [
                    'idCart' => $quoteTransfer->getUuid(),
                    'billingAddress' => $I->getAddressRequestPayload($quoteTransfer->getBillingAddress()),
                    'payments' => $I->getPaymentRequestPayload(),
                    'shipments' => [
                        $I->getSplitShipmentRequestPayloadWithCompanyBusinessUnitAddress(
                            $quoteTransfer->getItems()->offsetGet(0),
                            $this->fixtures->getCompanyUnitAddressTransfer(),
                        ),
                    ],
                ],
            ],
        ];

        // Act
        $I->sendPOST($I->buildCheckoutUrl(['orders', 'order-shipments']), $requestPayload);

        // Assert
        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->assertCompanyBusinessUnitShippingAddressInOrderShipments($this->fixtures->getCompanyUnitAddressTransfer());
    }
}
