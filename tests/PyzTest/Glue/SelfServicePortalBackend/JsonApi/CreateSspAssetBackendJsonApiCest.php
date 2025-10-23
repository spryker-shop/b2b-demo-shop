<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\SelfServicePortalBackend;

use Codeception\Util\HttpCode;
use PyzTest\Glue\SelfServicePortalBackend\JsonApi\Fixtures\SspAssetsBackendJsonApiFixtures;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group SelfServicePortalBackend
 * @group CreateSspAssetBackendJsonApiCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class CreateSspAssetBackendJsonApiCest
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
    public function requestCreateSspAssetWithValidData(SelfServicePortalBackendApiTester $I): void
    {
        // Arrange
        $oauthResponseTransfer = $I->havePasswordAuthorizationToBackendApi($this->fixtures->getUserTransfer());
        $I->amBearerAuthenticated($oauthResponseTransfer->getAccessToken());
        $companyBusinessUnitUUID = $this->fixtures->getCompanyBusinessUnitTransfer()->getUuid();

        $requestData = $I->buildAssetCreateRequestData(
            'New Asset',
            'NEW001_serialNumber_BAPI_TEST',
            'pending',
            'This is a test asset created via API',
            'https://example.com/image.png',
            $companyBusinessUnitUUID,
        );

        // Act
        $I->sendJsonApiPost($I->getCreateSspAssetUrl(), $requestData);

        // Assert
        $I->seeJsonApiResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->assertEquals('New Asset', $I->getJsonApiDataFromResponseByJsonPath('$.data.attributes.name'));
        $I->assertEquals('NEW001_serialNumber_BAPI_TEST', $I->getJsonApiDataFromResponseByJsonPath('$.data.attributes.serialNumber'));
        $I->assertEquals($companyBusinessUnitUUID, $I->getJsonApiDataFromResponseByJsonPath('$.data.attributes.companyBusinessUnitOwnerUuid'));
        $I->assertEquals('pending', $I->getJsonApiDataFromResponseByJsonPath('$.data.attributes.status'));
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\SelfServicePortalBackend\SelfServicePortalBackendApiTester $I
     */
    public function requestCreateSspAssetWithInvalidToken(SelfServicePortalBackendApiTester $I): void
    {
        // Arrange
        $I->amBearerAuthenticated('invalid-token');
        $companyBusinessUnitUUID = $this->fixtures->getCompanyBusinessUnitTransfer()->getUuid();

        $requestData = $I->buildAssetCreateRequestData(
            'New Asset',
            'NEW001_serialNumber_BAPI_TEST',
            'pending',
            'This is a test asset created via API',
            'https://example.com/image.png',
            $companyBusinessUnitUUID,
        );

        // Act
        $I->sendJsonApiPost($I->getCreateSspAssetUrl(), $requestData);

        // Assert
        $I->seeJsonApiResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function requestCreateSspAssetWithMissingName(SelfServicePortalBackendApiTester $I): void
    {
        // Arrange
        $oauthResponseTransfer = $I->havePasswordAuthorizationToBackendApi($this->fixtures->getUserTransfer());
        $I->amBearerAuthenticated($oauthResponseTransfer->getAccessToken());
        $companyBusinessUnitUUID = $this->fixtures->getCompanyBusinessUnitTransfer()->getUuid();

        $requestData = $I->buildAssetCreateRequestData(
            '',
            'NEW001_serialNumber_BAPI_TEST',
            'pending',
            'This is a test asset created via API',
            'https://example.com/image.png',
            $companyBusinessUnitUUID,
        );

        // Act
        $I->haveHttpHeader('Accept-Language', 'en-US');
        $I->sendJsonApiPost($I->getCreateSspAssetUrl(), $requestData);

        // Assert
        $I->seeJsonApiResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeJsonApiResponseErrorsHaveMessage('Asset name must be provided');
    }
}
