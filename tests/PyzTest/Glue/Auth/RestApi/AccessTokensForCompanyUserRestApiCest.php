<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\Auth\RestApi;

use Codeception\Util\HttpCode;
use PyzTest\Glue\Auth\AuthRestApiTester;
use Spryker\Glue\AuthRestApi\AuthRestApiConfig;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group Auth
 * @group RestApi
 * @group AccessTokensForCompanyUserRestApiCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class AccessTokensForCompanyUserRestApiCest
{
    /**
     * @var \PyzTest\Glue\Auth\RestApi\AccessTokensForCompanyUserRestApiFixtures
     */
    protected AccessTokensForCompanyUserRestApiFixtures $fixtures;

    /**
     * @param \PyzTest\Glue\Auth\AuthRestApiTester $I
     *
     * @return void
     */
    public function loadFixtures(AuthRestApiTester $I): void
    {
        /** @var \PyzTest\Glue\Auth\RestApi\AccessTokensForCompanyUserRestApiFixtures $fixtures */
        $fixtures = $I->loadFixtures(AccessTokensForCompanyUserRestApiFixtures::class);

        $this->fixtures = $fixtures;
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\Auth\AuthRestApiTester $I
     *
     * @return void
     */
    public function requestAccessTokenForExistingCustomerWithoutCompanyUser(AuthRestApiTester $I): void
    {
        // Act
        $I->sendPOST(AuthRestApiConfig::RESOURCE_ACCESS_TOKENS, [
            'data' => [
                'type' => AuthRestApiConfig::RESOURCE_ACCESS_TOKENS,
                'attributes' => [
                    'username' => $this->fixtures->getCustomerTransferWithoutCompanyUser()->getEmail(),
                    'password' => AccessTokensRestApiFixtures::TEST_PASSWORD,
                ],
            ],
        ]);

        // Assert
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->seeIdCompanyUserIsNull();
        $I->seeResponseHasRefreshToken();
        $I->seeResponseHasAccessToken();

        $I->seeResponseMatchesOpenApiSchema();
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\Auth\AuthRestApiTester $I
     *
     * @return void
     */
    public function requestAccessTokenForExistingCustomerWithCompanyUser(AuthRestApiTester $I): void
    {
        // Act
        $I->sendPOST(AuthRestApiConfig::RESOURCE_ACCESS_TOKENS, [
            'data' => [
                'type' => AuthRestApiConfig::RESOURCE_ACCESS_TOKENS,
                'attributes' => [
                    'username' => $this->fixtures->getCustomerTransferWithCompanyUser()->getEmail(),
                    'password' => AccessTokensRestApiFixtures::TEST_PASSWORD,
                ],
            ],
        ]);

        // Assert
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->seeIdCompanyUserEquals($this->fixtures->getCompanyUserTransfer()->getUuid());
        $I->seeResponseHasRefreshToken();
        $I->seeResponseHasAccessToken();

        $I->seeResponseMatchesOpenApiSchema();
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\Auth\AuthRestApiTester $I
     *
     * @return void
     */
    public function requestAccessTokenForCustomerWithTwoCompanyUserWithoutDefaultOne(AuthRestApiTester $I): void
    {
        // Act
        $I->sendPOST(AuthRestApiConfig::RESOURCE_ACCESS_TOKENS, [
            'data' => [
                'type' => AuthRestApiConfig::RESOURCE_ACCESS_TOKENS,
                'attributes' => [
                    'username' => $this->fixtures->getCustomerTransferWithTwoCompanyUsersWithoutDefaultOne()->getEmail(),
                    'password' => AccessTokensRestApiFixtures::TEST_PASSWORD,
                ],
            ],
        ]);

        // Assert
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->seeIdCompanyUserIsNull();
        $I->seeResponseHasRefreshToken();
        $I->seeResponseHasAccessToken();

        $I->seeResponseMatchesOpenApiSchema();
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\Auth\AuthRestApiTester $I
     *
     * @return void
     */
    public function requestAccessTokenForCustomerWithTwoCompanyUserWithDefaultOne(AuthRestApiTester $I): void
    {
        // Act
        $I->sendPOST(AuthRestApiConfig::RESOURCE_ACCESS_TOKENS, [
            'data' => [
                'type' => AuthRestApiConfig::RESOURCE_ACCESS_TOKENS,
                'attributes' => [
                    'username' => $this->fixtures->getCustomerTransferWithTwoCompanyUsersWithDefaultOne()->getEmail(),
                    'password' => AccessTokensRestApiFixtures::TEST_PASSWORD,
                ],
            ],
        ]);

        // Assert
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->seeIdCompanyUserEquals($this->fixtures->getDefaultCompanyUserTransfer()->getUuid());
        $I->seeResponseHasRefreshToken();
        $I->seeResponseHasAccessToken();

        $I->seeResponseMatchesOpenApiSchema();
    }
}
