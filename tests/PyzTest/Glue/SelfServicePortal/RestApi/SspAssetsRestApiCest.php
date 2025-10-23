<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\SelfServicePortal\RestApi;

use Codeception\Util\HttpCode;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use PyzTest\Glue\SelfServicePortal\RestApi\Fixtures\SspAssetsRestApiFixtures;
use PyzTest\Glue\SelfServicePortal\SelfServicePortalApiTester;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group SelfServicePortal
 * @group RestApi
 * @group SspAssetsRestApiCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class SspAssetsRestApiCest
{
    protected const RESOURCE_SSP_ASSETS = 'ssp-assets';

    protected const RESPONSE_DETAIL_ASSET_NOT_FOUND = 'Asset not found';

    protected SspAssetsRestApiFixtures $fixtures;

    public function loadFixtures(SelfServicePortalApiTester $I): void
    {
        /** @var \PyzTest\Glue\SelfServicePortal\RestApi\Fixtures\SspAssetsRestApiFixtures $fixtures */
        $fixtures = $I->loadFixtures(SspAssetsRestApiFixtures::class);
        $this->fixtures = $fixtures;
    }

    public function requestGetAssetsCollectionWithAuthorization(SelfServicePortalApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());

        // Act
        $I->sendGet($I->getSspAssetsUrl());

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('The returned resource is of correct type')
            ->whenI()
            ->seeResponseDataContainsResourceCollectionOfType(static::RESOURCE_SSP_ASSETS);

        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.name');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.reference');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.serialNumber');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.externalImageUrl');

        $I->assertResponseMatchAssetReference($this->fixtures->getAssetTransfer()->getReferenceOrFail());
    }

    public function requestGetSingleAssetWithValidId(SelfServicePortalApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());
        $assetId = $this->fixtures->getAssetTransfer()->getReferenceOrFail();

        // Act
        $I->sendGet($I->getSspAssetUrl((string)$assetId));

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('The returned resource is of correct type')
            ->whenI()
            ->seeResponseDataContainsSingleResourceOfType(static::RESOURCE_SSP_ASSETS);

        $I->assertEquals($assetId, $I->getDataFromResponseByJsonPath('$.data.id'));
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.name');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.reference');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.serialNumber');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.externalImageUrl');
    }

    public function requestGetSingleAssetWithInvalidId(SelfServicePortalApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());
        $invalidAssetId = '999999';

        // Act
        $I->sendGet($I->getSspAssetUrl($invalidAssetId));

        // Assert
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $errors = $I->getDataFromResponseByJsonPath('$.errors[0]');
        $I->assertEquals($errors[RestErrorMessageTransfer::STATUS], HttpCode::NOT_FOUND);
        $I->assertEquals($errors[RestErrorMessageTransfer::DETAIL], static::RESPONSE_DETAIL_ASSET_NOT_FOUND);
    }

    public function requestCreateAssetWithValidData(SelfServicePortalApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());

        $requestPayload = [
            'data' => [
                'type' => static::RESOURCE_SSP_ASSETS,
                'attributes' => [
                    'name' => 'New Test Asset from Glue',
                    'serialNumber' => 'serialNumberAsset1API',
                    'externalImageUrl' => 'https://example.com/new-asset.pdf',
                ],
            ],
        ];

        // Act
        $I->sendPost($I->getSspAssetsUrl(), $requestPayload);

        // Assert
        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('The returned resource is of correct type')
            ->whenI()
            ->seeResponseDataContainsSingleResourceOfType(static::RESOURCE_SSP_ASSETS);

        $I->assertEquals('New Test Asset from Glue', $I->getDataFromResponseByJsonPath('$.data.attributes.name'));
        $I->assertEquals('serialNumberAsset1API', $I->getDataFromResponseByJsonPath('$.data.attributes.serialNumber'));
        $I->assertEquals('https://example.com/new-asset.pdf', $I->getDataFromResponseByJsonPath('$.data.attributes.externalImageUrl'));
    }

    public function requestCreateAssetWithMissingRequiredFields(SelfServicePortalApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());

        $requestPayload = [
            'data' => [
                'type' => static::RESOURCE_SSP_ASSETS,
                'attributes' => [
                    // Missing required fields: name
                    'serialNumber' => 'serialNumberAsset5API',
                ],
            ],
        ];

        // Act
        $I->sendPost($I->getSspAssetsUrl(), $requestPayload);

        // Assert
        $I->seeResponseCodeIs(HttpCode::UNPROCESSABLE_ENTITY);
        $I->seeResponseMatchesOpenApiSchema();

        $errors = $I->getDataFromResponseByJsonPath('$.errors[0]');
        $I->assertEquals(HttpCode::UNPROCESSABLE_ENTITY, $errors[RestErrorMessageTransfer::STATUS]);
        $I->assertEquals('Asset name must be provided', $errors[RestErrorMessageTransfer::DETAIL]);
    }
}
