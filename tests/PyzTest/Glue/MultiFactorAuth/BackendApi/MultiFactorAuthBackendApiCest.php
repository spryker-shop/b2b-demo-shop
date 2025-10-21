<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\MultiFactorAuth\BackendApi;

use Codeception\Util\HttpCode;
use PyzTest\Glue\MultiFactorAuth\BackendApi\Fixtures\MultiFactorAuthBackendApiFixtures;
use PyzTest\Glue\MultiFactorAuth\MultiFactorAuthBackendApiTester;
use Spryker\Glue\MultiFactorAuth\MultiFactorAuthConfig;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Glue
 * @group MultiFactorAuth
 * @group BackendApi
 * @group MultiFactorAuthBackendApiCest
 * Add your own group annotations below this line
 */
class MultiFactorAuthBackendApiCest
{
    protected ?string $mfaCode = null;

    protected const INVALID_MFA_CODE = '000000';

    protected const INVALID_MFA_TYPE = 'invalid-type';

    protected ?MultiFactorAuthBackendApiFixtures $fixtures = null;

    public function loadFixtures(MultiFactorAuthBackendApiTester $I): void
    {
        /** @var \PyzTest\Glue\MultiFactorAuth\BackendApi\Fixtures\MultiFactorAuthBackendApiFixtures $fixtures */
        $fixtures = $I->loadFixtures(MultiFactorAuthBackendApiFixtures::class);
        $this->fixtures = $fixtures;
    }

    public function requestGetMultiFactorAuthTypes(MultiFactorAuthBackendApiTester $I): void
    {
        // Arrange
        $I->authorizeUserToBackendApi($this->fixtures->getUserTransfer());

        // Act
        $I->sendJsonApiGet($this->fixtures->generateUrl(MultiFactorAuthConfig::RESOURCE_MULTI_FACTOR_AUTH_TYPES));

        // Assert
        $I->seeJsonApiResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeJsonApiResponseDataContainsResourceCollectionOfType(MultiFactorAuthConfig::RESOURCE_MULTI_FACTOR_AUTH_TYPES);
    }

    public function requestActivateMultiFactorAuthType(MultiFactorAuthBackendApiTester $I): void
    {
        // Arrange
        $I->authorizeUserToBackendApi($this->fixtures->getUserTransfer());

        // Act
        $this->activateMultiFactorAuth($I);

        // Assert
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        $this->deactivateMultiFactorAuth($I);
    }

    public function requestActivateMultiFactorAuthTypeWithInvalidType(MultiFactorAuthBackendApiTester $I): void
    {
        // Arrange
        $I->authorizeUserToBackendApi($this->fixtures->getUserTransfer());

        // Act
        $requestPayload = [
            'data' => [
                'type' => MultiFactorAuthConfig::RESOURCE_MULTI_FACTOR_AUTH_TYPE_ACTIVATE,
                'attributes' => [
                    'type' => static::INVALID_MFA_TYPE,
                ],
            ],
        ];
        $I->sendJsonApiPost($this->fixtures->generateUrl(MultiFactorAuthConfig::RESOURCE_MULTI_FACTOR_AUTH_TYPE_ACTIVATE), $requestPayload);

        // Assert
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();

        $this->deactivateMultiFactorAuth($I);
    }

    public function requestVerifyMultiFactorAuthType(MultiFactorAuthBackendApiTester $I): void
    {
        // Arrange
        $I->authorizeUserToBackendApi($this->fixtures->getUserTransfer());

        // Act
        $this->activateMultiFactorAuth($I);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        $this->verifyMultiFactorAuth($I);

        // Assert
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        $this->deactivateMultiFactorAuth($I);
    }

    public function requestVerifyMultiFactorAuthTypeWithoutActivation(MultiFactorAuthBackendApiTester $I): void
    {
        // Arrange
        $I->authorizeUserToBackendApi($this->fixtures->getUserTransfer());

        // Act
        $this->verifyMultiFactorAuth($I);

        // Assert
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();

        $this->deactivateMultiFactorAuth($I);
    }

    public function requestVerifyMultiFactorAuthTypeWithInvalidCode(MultiFactorAuthBackendApiTester $I): void
    {
        // Arrange
        $I->authorizeUserToBackendApi($this->fixtures->getUserTransfer());

        $this->activateMultiFactorAuth($I);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        // Act
        $I->haveHttpHeader(MultiFactorAuthConfig::HEADER_MULTI_FACTOR_AUTH_CODE, static::INVALID_MFA_CODE);
        $requestPayload = $this->fixtures->createRequestPayload(MultiFactorAuthConfig::RESOURCE_MULTI_FACTOR_AUTH_TYPE_VERIFY);
        $I->sendJsonApiPost($this->fixtures->generateUrl(MultiFactorAuthConfig::RESOURCE_MULTI_FACTOR_AUTH_TYPE_VERIFY), $requestPayload);

        // Assert
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
        $I->seeResponseIsJson();

        $this->deactivateMultiFactorAuth($I);
    }

    public function requestDeactivateMultiFactorAuthType(MultiFactorAuthBackendApiTester $I): void
    {
        // Arrange
        $I->authorizeUserToBackendApi($this->fixtures->getUserTransfer());

        $this->activateMultiFactorAuth($I);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        $this->verifyMultiFactorAuth($I);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        $this->deactivateMultiFactorAuth($I);

        // Assert
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }

    public function requestDeactivateMultiFactorAuthTypeWithoutActivation(MultiFactorAuthBackendApiTester $I): void
    {
        // Arrange
        $I->authorizeUserToBackendApi($this->fixtures->getUserTransfer());

        // Act
        $this->deactivateMultiFactorAuth($I);

        // Assert
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
    }

    public function requestDeactivateMultiFactorAuthTypeWithInvalidCode(MultiFactorAuthBackendApiTester $I): void
    {
        // Arrange
        $I->authorizeUserToBackendApi($this->fixtures->getUserTransfer());

        $this->activateMultiFactorAuth($I);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        $this->verifyMultiFactorAuth($I);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        // Act
        $I->haveHttpHeader(MultiFactorAuthConfig::HEADER_MULTI_FACTOR_AUTH_CODE, static::INVALID_MFA_CODE);
        $requestPayload = $this->fixtures->createRequestPayload(MultiFactorAuthConfig::RESOURCE_MULTI_FACTOR_AUTH_TYPE_DEACTIVATE);
        $I->sendJsonApiPost($this->fixtures->generateUrl(MultiFactorAuthConfig::RESOURCE_MULTI_FACTOR_AUTH_TYPE_DEACTIVATE), $requestPayload);

        // Assert
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
        $I->seeResponseIsJson();

        $this->deactivateMultiFactorAuth($I);
    }

    public function requestDeactivateMultiFactorAuthTypeWithoutVerification(MultiFactorAuthBackendApiTester $I): void
    {
        // Arrange
        $I->authorizeUserToBackendApi($this->fixtures->getUserTransfer());

        $this->activateMultiFactorAuth($I);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        // Act
        $this->deactivateMultiFactorAuth($I);

        // Assert
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();

        $I->authorizeUserToBackendApi($this->fixtures->getUserTransfer());

        $this->verifyMultiFactorAuth($I);

        $this->deactivateMultiFactorAuth($I);
    }

    public function requestCreateWarehouseUserAssignmentsWithActivatedMultiFactorAuth(MultiFactorAuthBackendApiTester $I): void
    {
        // Arrange
        $I->authorizeUserToBackendApi($this->fixtures->getUserTransfer());

        $this->activateMultiFactorAuth($I);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        $this->verifyMultiFactorAuth($I);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        $I->haveHttpHeader(MultiFactorAuthConfig::HEADER_MULTI_FACTOR_AUTH_CODE, $this->mfaCode);
        $requestPayload = $this->fixtures->createWarehouseUserAssignmentsRequestPayload();

        // Act
        $I->sendJsonApiPost($this->fixtures->generateWarehouseUserAssignmentsUrl(), $requestPayload);

        // Assert
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();

        $this->deactivateMultiFactorAuth($I);
    }

    public function requestCreateWarehouseUserAssignmentsWithActivatedMultiFactorAuthButInvalidCode(MultiFactorAuthBackendApiTester $I): void
    {
        // Arrange
        $I->authorizeUserToBackendApi($this->fixtures->getUserTransfer());

        $this->activateMultiFactorAuth($I);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        $this->verifyMultiFactorAuth($I);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        $I->haveHttpHeader(MultiFactorAuthConfig::HEADER_MULTI_FACTOR_AUTH_CODE, static::INVALID_MFA_CODE);
        $requestPayload = $this->fixtures->createWarehouseUserAssignmentsRequestPayload();

        // Act
        $I->sendJsonApiPost($this->fixtures->generateWarehouseUserAssignmentsUrl(), $requestPayload);

        // Assert
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
        $I->seeResponseIsJson();

        $this->deactivateMultiFactorAuth($I);
    }

    public function requestCreateWarehouseUserAssignmentsWithActivatedMultiFactorAuthWithoutCode(MultiFactorAuthBackendApiTester $I): void
    {
        // Arrange
        $I->authorizeUserToBackendApi($this->fixtures->getUserTransfer());

        $this->activateMultiFactorAuth($I);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        $this->verifyMultiFactorAuth($I);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        $I->unsetHttpHeader(MultiFactorAuthConfig::HEADER_MULTI_FACTOR_AUTH_CODE);
        $requestPayload = $this->fixtures->createWarehouseUserAssignmentsRequestPayload();

        // Act
        $I->sendJsonApiPost($this->fixtures->generateWarehouseUserAssignmentsUrl(), $requestPayload);

        // Assert
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
        $I->seeResponseIsJson();
        $I->seeResponseContains(MultiFactorAuthConfig::ERROR_MESSAGE_MULTI_FACTOR_AUTH_CODE_MISSING);

        $this->deactivateMultiFactorAuth($I);
    }

    protected function activateMultiFactorAuth(MultiFactorAuthBackendApiTester $I): void
    {
        $requestPayload = $this->fixtures->createRequestPayload(MultiFactorAuthConfig::RESOURCE_MULTI_FACTOR_AUTH_TYPE_ACTIVATE);
        $I->sendJsonApiPost($this->fixtures->generateUrl(MultiFactorAuthConfig::RESOURCE_MULTI_FACTOR_AUTH_TYPE_ACTIVATE), $requestPayload);
    }

    protected function verifyMultiFactorAuth(MultiFactorAuthBackendApiTester $I): void
    {
        $this->mfaCode = $I->getUserMultiFactorAuthCodeFromDatabase(
            $this->fixtures->getUserTransfer(),
            'email',
        );

        $I->comment(sprintf('Using MFA code from database: %s', $this->mfaCode));

        $requestPayload = $this->fixtures->createRequestPayload(MultiFactorAuthConfig::RESOURCE_MULTI_FACTOR_AUTH_TYPE_VERIFY);
        if ($this->mfaCode !== null) {
            $I->haveHttpHeader(MultiFactorAuthConfig::HEADER_MULTI_FACTOR_AUTH_CODE, $this->mfaCode);
        }
        $I->sendJsonApiPost($this->fixtures->generateUrl(MultiFactorAuthConfig::RESOURCE_MULTI_FACTOR_AUTH_TYPE_VERIFY), $requestPayload);
    }

    protected function deactivateMultiFactorAuth(MultiFactorAuthBackendApiTester $I): void
    {
        if ($this->mfaCode === null) {
            $this->mfaCode = $I->getUserMultiFactorAuthCodeFromDatabase(
                $this->fixtures->getUserTransfer(),
                'email',
            );
            $I->comment(sprintf('Using MFA code from database for deactivation: %s', $this->mfaCode));
        }

        if ($this->mfaCode !== null) {
            $I->haveHttpHeader(MultiFactorAuthConfig::HEADER_MULTI_FACTOR_AUTH_CODE, $this->mfaCode);
        }
        $requestPayload = $this->fixtures->createRequestPayload(MultiFactorAuthConfig::RESOURCE_MULTI_FACTOR_AUTH_TYPE_DEACTIVATE);
        $I->sendJsonApiPost($this->fixtures->generateUrl(MultiFactorAuthConfig::RESOURCE_MULTI_FACTOR_AUTH_TYPE_DEACTIVATE), $requestPayload);
    }
}
