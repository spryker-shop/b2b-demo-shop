<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\Checkout\RestApi;

use Codeception\Util\HttpCode;
use PyzTest\Glue\Checkout\CheckoutApiTester;
use PyzTest\Glue\Checkout\RestApi\Fixtures\CompanyBusinessUnitAddressCheckoutDataRestApiFixtures;
use Spryker\Glue\CheckoutRestApi\CheckoutRestApiConfig;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group Checkout
 * @group RestApi
 * @group CompanyBusinessUnitAddressCheckoutDataRestApiCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class CompanyBusinessUnitAddressCheckoutDataRestApiCest
{
    /**
     * @var \PyzTest\Glue\Checkout\RestApi\Fixtures\CompanyBusinessUnitAddressCheckoutDataRestApiFixtures
     */
    protected CompanyBusinessUnitAddressCheckoutDataRestApiFixtures $fixtures;

    /**
     * @param \PyzTest\Glue\Checkout\CheckoutApiTester $I
     *
     * @return void
     */
    public function loadFixtures(CheckoutApiTester $I): void
    {
        $fixtures = $I->loadFixtures(CompanyBusinessUnitAddressCheckoutDataRestApiFixtures::class);
        $this->fixtures = $fixtures;
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\Checkout\CheckoutApiTester $I
     *
     * @return void
     */
    public function requestCheckoutDataReturnsCompanyBusinessUnitAddressesInIncludes(CheckoutApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());
        $quoteTransfer = $this->fixtures->getQuoteTransfer();

        $requestPayload = [
            'data' => [
                'type' => CheckoutRestApiConfig::RESOURCE_CHECKOUT_DATA,
                'attributes' => [
                    'idCart' => $quoteTransfer->getUuid(),
                ],
            ],
        ];

        // Act
        $I->sendPOST($I->buildCheckoutDataUrl(['company-business-unit-addresses']), $requestPayload);

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $jsonPath = sprintf('$..included[?(@.type == \'%s\')]', 'company-business-unit-addresses');
        $companyBusinessUnitAddresses = $I->getDataFromResponseByJsonPath($jsonPath)[0];

        $I->amSure('The response contains includes expected company-business-unit-addresses resource')
            ->whenI()
            ->assertNotNull($companyBusinessUnitAddresses);

        $I->assertSame(
            $this->fixtures->getCompanyUnitAddressTransfer()->getUuid(),
            $companyBusinessUnitAddresses['id'],
        );
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\Checkout\CheckoutApiTester $I
     *
     * @return void
     */
    public function requestCheckoutDataReturnsShipmentsWithMappedCompanyBusinessUnitAddressId(CheckoutApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());
        $quoteTransfer = $this->fixtures->getQuoteTransfer();

        $requestPayload = [
            'data' => [
                'type' => CheckoutRestApiConfig::RESOURCE_CHECKOUT_DATA,
                'attributes' => [
                    'idCart' => $quoteTransfer->getUuid(),
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
        $I->sendPOST($I->buildCheckoutDataUrl(['shipments']), $requestPayload);

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $jsonPath = sprintf('$..included[?(@.type == \'%s\')]', 'shipments');
        $shipments = $I->getDataFromResponseByJsonPath($jsonPath)[0];

        $I->assertSame(
            $this->fixtures->getCompanyUnitAddressTransfer()->getUuid(),
            $shipments['attributes']['shippingAddress']['idCompanyBusinessUnitAddress'],
        );
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\Checkout\CheckoutApiTester $I
     *
     * @return void
     */
    public function requestCheckoutDataShouldAcceptCompanyBusinessUnitAddressForBillingAddress(CheckoutApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());
        $quoteTransfer = $this->fixtures->getQuoteTransfer();

        $requestPayload = [
            'data' => [
                'type' => CheckoutRestApiConfig::RESOURCE_CHECKOUT_DATA,
                'attributes' => [
                    'idCart' => $quoteTransfer->getUuid(),
                    'billingAddress' => [
                        'idCompanyBusinessUnitAddress' => $this->fixtures->getCompanyUnitAddressTransfer()->getUuid(),
                    ],
                ],
            ],
        ];

        // Act
        $I->sendPOST($I->buildCheckoutDataUrl(), $requestPayload);

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
    }
}
