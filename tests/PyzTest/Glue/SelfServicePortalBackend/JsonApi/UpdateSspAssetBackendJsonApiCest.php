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
 * @group UpdateSspAssetBackendJsonApiCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class UpdateSspAssetBackendJsonApiCest
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
    public function requestUpdateSspAssetWithValidData(SelfServicePortalBackendApiTester $I): void
    {
        // Arrange
        $oauthResponseTransfer = $I->havePasswordAuthorizationToBackendApi($this->fixtures->getUserTransfer());
        $I->amBearerAuthenticated($oauthResponseTransfer->getAccessToken());
        $sspAssetReference = $this->fixtures->getAssetTransfer()->getReference();

        $requestData = $I->buildAssetUpdateRequestData(
            'NEW001_serialNumber_BAPI_TEST_PATCHED',
            'NOTE_PATCHED',
            'https://example.com/image_PATCHED.png',
            'New Asset PATCHED',
        );

        // Act
        $I->sendJsonApiPatch($I->getUpdateSspAssetUrl($sspAssetReference), $requestData);

        // Assert
        $I->seeJsonApiResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->assertEquals('New Asset PATCHED', $I->getJsonApiDataFromResponseByJsonPath('$.data.attributes.name'));
        $I->assertEquals('NEW001_serialNumber_BAPI_TEST_PATCHED', $I->getJsonApiDataFromResponseByJsonPath('$.data.attributes.serialNumber'));
        $I->assertEquals('https://example.com/image_PATCHED.png', $I->getJsonApiDataFromResponseByJsonPath('$.data.attributes.externalImageUrl'));
        $I->assertEquals('NOTE_PATCHED', $I->getJsonApiDataFromResponseByJsonPath('$.data.attributes.note'));
    }

    public function requestUpdateSspAssetWithInvalidToken(SelfServicePortalBackendApiTester $I): void
    {
        // Arrange
        $sspAssetReference = $this->fixtures->getAssetTransfer()->getReference();
        $I->amBearerAuthenticated('invalid-token');

        $requestData = $I->buildAssetUpdateRequestData(
            'New Asset',
            'NEW001_serialNumber_BAPI_TEST',
            'pending',
            'https://example.com/image.png',
        );

        // Act
        $I->sendJsonApiPatch($I->getUpdateSspAssetUrl($sspAssetReference), $requestData);

        // Assert
        $I->seeJsonApiResponseCodeIs(HttpCode::UNAUTHORIZED);
    }
}
