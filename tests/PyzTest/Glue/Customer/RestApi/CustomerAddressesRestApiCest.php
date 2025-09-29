<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\Customer\RestApi;

use Codeception\Util\HttpCode;
use Generated\Shared\Transfer\CustomerTransfer;
use PyzTest\Glue\Customer\CustomerApiTester;
use Spryker\Glue\CustomersRestApi\CustomersRestApiConfig;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group Customer
 * @group RestApi
 * @group CustomerAddressesRestApiCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class CustomerAddressesRestApiCest
{
    protected CustomerRestApiFixtures $fixtures;

    protected CustomerTransfer $customerTransfer;

    public function _before(CustomerApiTester $I): void
    {
        /** @var \PyzTest\Glue\Customer\RestApi\CustomerRestApiFixtures $fixtures */
        $fixtures = $I->loadFixtures(CustomerRestApiFixtures::class);

        $this->fixtures = $fixtures;

        // Arrange
        $this->customerTransfer = $I->haveCustomer(
            [
                CustomerTransfer::NEW_PASSWORD => 'change123',
                CustomerTransfer::PASSWORD => 'change123',
            ],
        );
        $I->confirmCustomer($this->customerTransfer);

        $oauthResponseTransfer = $I->haveAuthorizationToGlue($this->customerTransfer);
        $I->amBearerAuthenticated($oauthResponseTransfer->getAccessToken());
    }

    public function requestGetCustomerAddresses(CustomerApiTester $I): void
    {
        // Act
        $I->sendGet(
            $I->formatUrl(
                '{resourceCustomers}/{customerReference}/addresses',
                [
                    'resourceCustomers' => CustomersRestApiConfig::RESOURCE_CUSTOMERS,
                    'customerReference' => $this->customerTransfer->getCustomerReference(),
                ],
            ),
        );

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();
    }

    public function requestGetCustomerAddressesAuthorizationError(CustomerApiTester $I): void
    {
        // Act
        $I->sendGet(
            $I->formatUrl(
                '{resourceCustomers}/{customerReference}/addresses',
                [
                    'resourceCustomers' => CustomersRestApiConfig::RESOURCE_CUSTOMERS,
                    'customerReference' => 'wrongCustomerReference',
                ],
            ),
        );

        // Assert
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();
    }
}
