<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\SelfServicePortalBackend\JsonApi\Fixtures;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\SspAssetBusinessUnitAssignmentTransfer;
use Generated\Shared\Transfer\SspAssetTransfer;
use Generated\Shared\Transfer\UserTransfer;
use PyzTest\Glue\SelfServicePortalBackend\SelfServicePortalBackendApiTester;
use SprykerTest\Shared\Testify\Fixtures\FixturesBuilderInterface;
use SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface;

class SspAssetsBackendJsonApiFixtures implements FixturesBuilderInterface, FixturesContainerInterface
{
    protected const TEST_USERNAME = 'SspAssetsBackendApiFixtures';

    protected const TEST_USER_PASSWORD = 'change123';

    protected const TEST_COMPANY_NAME = 'Test Company';

    protected const TEST_PASSWORD = 'change123';

    protected const TEST_ASSET_URL = 'https://example.com/asset.pdf';

    protected CustomerTransfer $customerTransfer;

    protected CompanyTransfer $companyTransfer;

    protected CompanyUserTransfer $companyUserTransfer;

    protected SspAssetTransfer $assetTransfer;

    protected CompanyBusinessUnitTransfer $companyBusinessUnitTransfer;

    protected UserTransfer $userTransfer;

    public function buildFixtures(SelfServicePortalBackendApiTester $I): FixturesContainerInterface
    {
        $this->createCompany($I);
        $this->createCustomer($I);
        $this->createCompanyBusinessUnit($I);
        $this->createCompanyUser($I);
        $this->createAssets($I);
        $this->createUsers($I);

        return $this;
    }

    public function getCustomerTransfer(): CustomerTransfer
    {
        return $this->customerTransfer;
    }

    public function getCompanyTransfer(): CompanyTransfer
    {
        return $this->companyTransfer;
    }

    public function getCompanyUserTransfer(): CompanyUserTransfer
    {
        return $this->companyUserTransfer;
    }

    public function getAssetTransfer(): SspAssetTransfer
    {
        return $this->assetTransfer;
    }

    public function getUserTransfer(): UserTransfer
    {
        return $this->userTransfer;
    }

    public function getCompanyBusinessUnitTransfer(): CompanyBusinessUnitTransfer
    {
        return $this->companyBusinessUnitTransfer;
    }

    protected function createCompany(SelfServicePortalBackendApiTester $I): void
    {
        $this->companyTransfer = $I->haveCompany([
            CompanyTransfer::NAME => static::TEST_COMPANY_NAME,
            CompanyTransfer::STATUS => 'approved',
            CompanyTransfer::IS_ACTIVE => true,
        ]);
    }

    protected function createCustomer(SelfServicePortalBackendApiTester $I): void
    {
        $customerTransfer = $I->haveCustomer([
            CustomerTransfer::USERNAME => static::TEST_USERNAME,
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);

        $this->customerTransfer = $I->confirmCustomer($customerTransfer);
    }

    protected function createCompanyUser(SelfServicePortalBackendApiTester $I): void
    {
        $this->companyUserTransfer = $I->haveCompanyUser([
            CompanyUserTransfer::CUSTOMER => $this->customerTransfer,
            CompanyUserTransfer::FK_COMPANY => $this->companyTransfer->getIdCompany(),
            CompanyUserTransfer::FK_COMPANY_BUSINESS_UNIT => $this->companyBusinessUnitTransfer->getIdCompanyBusinessUnit(),
        ]);
    }

    protected function createCompanyBusinessUnit(SelfServicePortalBackendApiTester $I): void
    {
        $this->companyBusinessUnitTransfer = $I->haveCompanyBusinessUnit([
            CompanyBusinessUnitTransfer::FK_COMPANY => $this->companyTransfer->getIdCompany(),
        ]);

        $I->haveCompanyUnitAddressToCompanyBusinessUnitRelation($this->companyBusinessUnitTransfer);
    }

    protected function createAssets(SelfServicePortalBackendApiTester $I): void
    {
        $this->assetTransfer = $I->haveAsset([
            SspAssetTransfer::REFERENCE => 'ASSET-bapi_test_asset',
            SspAssetTransfer::EXTERNAL_IMAGE_URL => static::TEST_ASSET_URL,
            SspAssetTransfer::COMPANY_BUSINESS_UNIT => $this->companyBusinessUnitTransfer,
            SspAssetTransfer::SERIAL_NUMBER => 'bapi_test_asset',
            SspAssetTransfer::NOTE => 'This is a test asset. Note field.',
            SspAssetTransfer::BUSINESS_UNIT_ASSIGNMENTS => [
                [SspAssetBusinessUnitAssignmentTransfer::COMPANY_BUSINESS_UNIT => $this->companyBusinessUnitTransfer],
            ],
        ]);
    }

    protected function createUsers(SelfServicePortalBackendApiTester $I): void
    {
        $this->userTransfer = $I->haveUser([
            UserTransfer::PASSWORD => static::TEST_USER_PASSWORD,
        ]);

        $this->userTransfer->setPassword(static::TEST_USER_PASSWORD);
    }
}
