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
 * @group GetCollectionSspAssetsBackendJsonApiCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class GetCollectionSspAssetsBackendJsonApiCest
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
    public function requestGetCollectionSspAssetsWithInvalidToken(SelfServicePortalBackendApiTester $I): void
    {
        // Arrange
        $I->amBearerAuthenticated('invalid-token');

        // Act
        $I->sendJsonApiGet($I->getGetCollectionSspAssetsUrl());

        // Assert
        $I->seeJsonApiResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\SelfServicePortalBackend\SelfServicePortalBackendApiTester $I
     */
    public function requestGetCollectionSspAssetsWithValidToken(SelfServicePortalBackendApiTester $I): void
    {
        // Arrange
        $oauthResponseTransfer = $I->havePasswordAuthorizationToBackendApi($this->fixtures->getUserTransfer());
        $I->amBearerAuthenticated($oauthResponseTransfer->getAccessToken());

        // Act
        $I->sendJsonApiGet($I->getGetCollectionSspAssetsUrl());

        // Assert
        $I->seeJsonApiResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('The returned resource is of correct type')
            ->whenI()
            ->seeJsonApiResponseDataContainsResourceCollectionOfType('ssp-assets');

        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.name');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.reference');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.serialNumber');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.status');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.note');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.createdDate');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.companyBusinessUnitOwnerUuid');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.externalImageUrl');
    }
}
