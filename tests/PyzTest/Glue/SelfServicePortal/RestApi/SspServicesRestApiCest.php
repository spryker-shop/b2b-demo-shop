<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\SelfServicePortal\RestApi;

use Codeception\Util\HttpCode;
use PyzTest\Glue\SelfServicePortal\RestApi\Fixtures\SspServicesRestApiFixtures;
use PyzTest\Glue\SelfServicePortal\SelfServicePortalApiTester;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group SelfServicePortal
 * @group RestApi
 * @group SspServicesRestApiCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class SspServicesRestApiCest
{
    protected const RESOURCE_SSP_SERVICES = 'booked-services';

    protected SspServicesRestApiFixtures $fixtures;

    public function loadFixtures(SelfServicePortalApiTester $I): void
    {
        /** @var \PyzTest\Glue\SelfServicePortal\RestApi\Fixtures\SspServicesRestApiFixtures $fixtures */
        $fixtures = $I->loadFixtures(SspServicesRestApiFixtures::class);
        $this->fixtures = $fixtures;
    }

    public function requestGetServicesCollectionWhenCompanyUserHasSeeCompanyOrdersPermission(SelfServicePortalApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerWithCompanyOrderViewPermissionTransfer());

        // Act
        $I->sendGet($I->getSspServicesUrl());

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('The returned resource is of correct type')
            ->whenI()
            ->seeResponseDataContainsResourceCollectionOfType(static::RESOURCE_SSP_SERVICES);

        $I->amSure('The returned number of resources is correct')
            ->whenI()
            ->assertNumberOfResources(2);

        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.uuid');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.productName');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.scheduledAt');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.createdAt');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.stateDisplayName');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.stateName');
    }

    public function requestGetServicesCollectionWithoutCompanyOrBusinessUnitPermissionsShouldSeeOnlyOwnOrders(SelfServicePortalApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());

        // Act
        $I->sendGet($I->getSspServicesUrl());

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('The returned resource is of correct type')
            ->whenI()
            ->seeResponseDataContainsResourceCollectionOfType(static::RESOURCE_SSP_SERVICES);

        $I->amSure('The returned number of resources is correct')
            ->whenI()
            ->assertNumberOfResources(1);

        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.uuid');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.productName');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.scheduledAt');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.createdAt');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.stateDisplayName');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.stateName');
    }

    public function requestGetServicesCollectionWithoutAuthorization(SelfServicePortalApiTester $I): void
    {
        // Act
        $I->sendGet($I->getSspServicesUrl());

        // Assert
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }
}
