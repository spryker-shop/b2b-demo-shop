<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\SelfServicePortalBackend\JsonApi;

use Codeception\Util\HttpCode;
use PyzTest\Glue\SelfServicePortalBackend\JsonApi\Fixtures\SspAssetsBackendJsonApiFixtures;
use PyzTest\Glue\SelfServicePortalBackend\SelfServicePortalBackendApiTester;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group SelfServicePortalBackend
 * @group JsonApi
 * @group GetSingleSspAssetBackendJsonApiCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class GetSingleSspAssetBackendJsonApiCest
{
    protected SspAssetsBackendJsonApiFixtures $fixtures;

    public function loadFixtures(SelfServicePortalBackendApiTester $I): void
    {
        /** @var \PyzTest\Glue\SelfServicePortalBackend\JsonApi\Fixtures\SspAssetsBackendJsonApiFixtures $fixtures */
        $fixtures = $I->loadFixtures(SspAssetsBackendJsonApiFixtures::class);
        $this->fixtures = $fixtures;
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\SelfServicePortalBackend\SelfServicePortalBackendApiTester $I
     */
    public function requestGetSingleSspAssetWithValidToken(SelfServicePortalBackendApiTester $I): void
    {
        // Arrange
        // Arrange
        $oauthResponseTransfer = $I->havePasswordAuthorizationToBackendApi($this->fixtures->getUserTransfer());
        $I->amBearerAuthenticated($oauthResponseTransfer->getAccessToken());
        $sspAssetReference = $this->fixtures->getAssetTransfer()->getReference();

        // Act
        $I->sendJsonApiGet($I->getGetSspAssetUrl($sspAssetReference));

        // Assert
        $I->seeJsonApiResponseCodeIs(HttpCode::OK);
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('The returned resource is of correct type')
            ->whenI()
            ->seeJsonApiResponseDataContainsSingleResourceOfType('ssp-assets');

        $I->assertEquals($sspAssetReference, $I->getJsonApiDataFromResponseByJsonPath('$.data.id'));
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.name');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.reference');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.serialNumber');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.externalImageUrl');
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\SelfServicePortalBackend\SelfServicePortalBackendApiTester $I
     */
    public function requestGetSingleSspAssetWithInvalidToken(SelfServicePortalBackendApiTester $I): void
    {
        // Arrange
        $testAssetReference = $this->fixtures->getAssetTransfer()->getReference();
        $I->amBearerAuthenticated('invalid-token');

        // Act
        $I->sendJsonApiGet($I->getGetSspAssetUrl($testAssetReference));

        // Assert
        $I->seeJsonApiResponseCodeIs(HttpCode::UNAUTHORIZED);
    }
}
