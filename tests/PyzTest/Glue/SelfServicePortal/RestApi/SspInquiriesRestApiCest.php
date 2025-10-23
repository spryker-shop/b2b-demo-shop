<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\SelfServicePortal\RestApi;

use Codeception\Util\HttpCode;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use PyzTest\Glue\SelfServicePortal\RestApi\Fixtures\SspInquiriesRestApiFixtures;
use PyzTest\Glue\SelfServicePortal\SelfServicePortalApiTester;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group SelfServicePortal
 * @group RestApi
 * @group SspInquiriesRestApiCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class SspInquiriesRestApiCest
{
    protected const RESOURCE_SSP_INQUIRIES = 'ssp-inquiries';

    protected const RESPONSE_DETAIL_INQUIRY_NOT_FOUND = 'Inquiry not found';

    protected SspInquiriesRestApiFixtures $fixtures;

    public function loadFixtures(SelfServicePortalApiTester $I): void
    {
        /** @var \PyzTest\Glue\SelfServicePortal\RestApi\Fixtures\SspInquiriesRestApiFixtures $fixtures */
        $fixtures = $I->loadFixtures(SspInquiriesRestApiFixtures::class);
        $this->fixtures = $fixtures;
    }

    public function requestGetInquiriesCollectionWithAuthorization(SelfServicePortalApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());

        // Act
        $I->sendGet($I->getSspInquiriesUrl());

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('The returned resource is of correct type')
            ->whenI()
            ->seeResponseDataContainsResourceCollectionOfType(static::RESOURCE_SSP_INQUIRIES);

        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.subject');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.reference');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.status');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.type');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.sspAssetReference');
        $I->seeResponseJsonMatchesJsonPath('$.data[*].attributes.orderReference');
    }

    public function requestGetSingleInquiryWithValidId(SelfServicePortalApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());
        $inquiryId = $this->fixtures->getInquiryTransfer()->getReferenceOrFail();

        // Act
        $I->sendGet($I->getSspInquiryUrl((string)$inquiryId));

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('The returned resource is of correct type')
            ->whenI()
            ->seeResponseDataContainsSingleResourceOfType(static::RESOURCE_SSP_INQUIRIES);

        $I->assertEquals($inquiryId, $I->getDataFromResponseByJsonPath('$.data.id'));
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.subject');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.reference');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.status');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.type');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.sspAssetReference');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.orderReference');

        $I->assertResponseMatchInquiryReference($this->fixtures->getInquiryTransfer()->getReferenceOrFail());
    }

    public function requestGetSingleInquiryWithValidIdAndOrder(SelfServicePortalApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());
        $inquiryReference = $this->fixtures->getInquiryWithOrderTransfer()->getReferenceOrFail();

        // Act
        $I->sendGet($I->getSspInquiryUrl((string)$inquiryReference));

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('The returned resource is of correct type')
            ->whenI()
            ->seeResponseDataContainsSingleResourceOfType(static::RESOURCE_SSP_INQUIRIES);

        $I->assertEquals($inquiryReference, $I->getDataFromResponseByJsonPath('$.data.id'));
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.subject');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.reference');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.status');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.type');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.sspAssetReference');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.orderReference');

        $I->assertResponseMatchInquiryReference($inquiryReference);
        $I->assertResponseMatchOrderReferenceAttachedToInquiry($this->fixtures->getInquiryWithOrderTransfer()->getOrder()->getOrderReference());
    }

    public function requestGetSingleInquiryWithValidIdAndAsset(SelfServicePortalApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());
        $inquiryReference = $this->fixtures->getInquiryWithAssetTransfer()->getReferenceOrFail();

        // Act
        $I->sendGet($I->getSspInquiryUrl((string)$inquiryReference));

        // Assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('The returned resource is of correct type')
            ->whenI()
            ->seeResponseDataContainsSingleResourceOfType(static::RESOURCE_SSP_INQUIRIES);

        $I->assertEquals($inquiryReference, $I->getDataFromResponseByJsonPath('$.data.id'));
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.subject');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.reference');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.status');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.type');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.sspAssetReference');
        $I->seeResponseJsonMatchesJsonPath('$.data.attributes.orderReference');

        $I->assertResponseMatchInquiryReference($inquiryReference);
        $I->assertResponseMatchAssetReferenceAttachedToInquiry($this->fixtures->getInquiryWithAssetTransfer()->getSspAsset()->getReference());
    }

    public function requestGetSingleInquiryWithInvalidId(SelfServicePortalApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());
        $invalidInquiryId = '999999';

        // Act
        $I->sendGet($I->getSspInquiryUrl($invalidInquiryId));

        // Assert
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $errors = $I->getDataFromResponseByJsonPath('$.errors[0]');
        $I->assertEquals($errors[RestErrorMessageTransfer::STATUS], HttpCode::NOT_FOUND);
        $I->assertEquals($errors[RestErrorMessageTransfer::DETAIL], static::RESPONSE_DETAIL_INQUIRY_NOT_FOUND);
    }

    public function requestCreateInquiryWithValidData(SelfServicePortalApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());

        $requestPayload = [
            'data' => [
                'type' => static::RESOURCE_SSP_INQUIRIES,
                'attributes' => [
                    'subject' => 'New Test Inquiry from Glue',
                    'description' => 'This is a test inquiry description',
                    'type' => 'general',
                    'sspAssetReference' => $this->fixtures->getAssetTransfer()->getReference(),
                    'orderReference' => $this->fixtures->getSaveOrderTransfer()->getOrderReference(),
                ],
            ],
        ];

        // Act
        $I->sendPost($I->getSspInquiriesUrl(), $requestPayload);

        // Assert
        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('The returned resource is of correct type')
            ->whenI()
            ->seeResponseDataContainsSingleResourceOfType(static::RESOURCE_SSP_INQUIRIES);

        $I->assertEquals('New Test Inquiry from Glue', $I->getDataFromResponseByJsonPath('$.data.attributes.subject'));
        $I->assertEquals('This is a test inquiry description', $I->getDataFromResponseByJsonPath('$.data.attributes.description'));
        $I->assertEquals('general', $I->getDataFromResponseByJsonPath('$.data.attributes.type'));
        $I->assertEquals($this->fixtures->getAssetTransfer()->getReference(), $I->getDataFromResponseByJsonPath('$.data.attributes.sspAssetReference'));
        $I->assertEquals($this->fixtures->getSaveOrderTransfer()->getOrderReference(), $I->getDataFromResponseByJsonPath('$.data.attributes.orderReference'));
    }

    public function requestCreateInquiryWithMissingRequiredFields(SelfServicePortalApiTester $I): void
    {
        // Arrange
        $I->authorizeCustomerToGlue($this->fixtures->getCustomerTransfer());

        $requestPayload = [
            'data' => [
                'type' => static::RESOURCE_SSP_INQUIRIES,
                'attributes' => [
                    // Missing required fields: subject
                    'description' => 'This is a test inquiry description',
                    'subject' => 'subject',
                ],
            ],
        ];

        // Act
        $I->sendPost($I->getSspInquiriesUrl(), $requestPayload);

        // Assert
        $I->seeResponseCodeIs(HttpCode::UNPROCESSABLE_ENTITY);
        $I->seeResponseMatchesOpenApiSchema();

        $errors = $I->getDataFromResponseByJsonPath('$.errors[0]');
        $I->assertEquals(HttpCode::UNPROCESSABLE_ENTITY, $errors[RestErrorMessageTransfer::STATUS]);
        $I->assertEquals('Inquiry type is missing.', $errors[RestErrorMessageTransfer::DETAIL]);
    }
}
