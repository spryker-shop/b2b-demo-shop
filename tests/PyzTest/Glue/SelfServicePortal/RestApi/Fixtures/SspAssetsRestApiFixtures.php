<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\SelfServicePortal\RestApi\Fixtures;

use Generated\Shared\DataBuilder\CompanyRoleCollectionBuilder;
use Generated\Shared\DataBuilder\PermissionCollectionBuilder;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\PermissionCollectionTransfer;
use Generated\Shared\Transfer\SspAssetBusinessUnitAssignmentTransfer;
use Generated\Shared\Transfer\SspAssetTransfer;
use PyzTest\Glue\SelfServicePortal\SelfServicePortalApiTester;
use SprykerFeature\Shared\SelfServicePortal\Plugin\Permission\CreateSspAssetPermissionPlugin;
use SprykerFeature\Shared\SelfServicePortal\Plugin\Permission\ViewBusinessUnitSspAssetPermissionPlugin;
use SprykerFeature\Shared\SelfServicePortal\Plugin\Permission\ViewCompanySspAssetPermissionPlugin;
use SprykerTest\Shared\Testify\Fixtures\FixturesBuilderInterface;
use SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface;

class SspAssetsRestApiFixtures implements FixturesBuilderInterface, FixturesContainerInterface
{
    protected const TEST_USERNAME = 'SspAssetsRestApiFixtures';

    protected const TEST_PASSWORD = 'change123';

    protected const TEST_COMPANY_NAME = 'Test Company';

    protected const TEST_ASSET_URL = 'https://example.com/asset.pdf';

    public const PERMISSION_PLUGINS = [
        ViewBusinessUnitSspAssetPermissionPlugin::class,
        ViewCompanySspAssetPermissionPlugin::class,
        CreateSspAssetPermissionPlugin::class,
    ];

    protected CustomerTransfer $customerTransfer;

    protected CompanyTransfer $companyTransfer;

    protected CompanyUserTransfer $companyUserTransfer;

    protected SspAssetTransfer $assetTransfer;

    protected SspAssetTransfer $secondAssetTransfer;

    protected CompanyBusinessUnitTransfer $companyBusinessUnitTransfer;

    protected CompanyUnitAddressTransfer $companyUnitAddressTransfer;

    protected PermissionCollectionTransfer $permissionCollectionTransfer;

    public function buildFixtures(SelfServicePortalApiTester $I): FixturesContainerInterface
    {
        $this->createCompany($I);
        $this->createCustomer($I);
        $this->createCompanyBusinessUnit($I);
        $this->createCompanyUser($I);
        $this->createAssets($I);

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

    public function getSecondAssetTransfer(): SspAssetTransfer
    {
        return $this->secondAssetTransfer;
    }

    protected function createCompany(SelfServicePortalApiTester $I): void
    {
        $this->companyTransfer = $I->haveCompany([
            CompanyTransfer::NAME => static::TEST_COMPANY_NAME,
            CompanyTransfer::STATUS => 'approved',
            CompanyTransfer::IS_ACTIVE => true,
        ]);

        $this->companyUnitAddressTransfer = $I->haveCompanyUnitAddress([
            CompanyUnitAddressTransfer::FK_COMPANY => $this->companyTransfer->getIdCompany(),
        ]);
    }

    protected function createCustomer(SelfServicePortalApiTester $I): void
    {
        $customerTransfer = $I->haveCustomer([
            CustomerTransfer::USERNAME => static::TEST_USERNAME,
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);

        $this->customerTransfer = $I->confirmCustomer($customerTransfer);
    }

    protected function createCompanyUser(SelfServicePortalApiTester $I): void
    {
        $this->companyUserTransfer = $I->haveCompanyUser([
            CompanyUserTransfer::CUSTOMER => $this->customerTransfer,
            CompanyUserTransfer::FK_COMPANY => $this->companyTransfer->getIdCompany(),
            CompanyUserTransfer::FK_COMPANY_BUSINESS_UNIT => $this->companyBusinessUnitTransfer->getIdCompanyBusinessUnit(),
        ]);

        $this->permissionCollectionTransfer = (new PermissionCollectionBuilder())->build();
        foreach (static::PERMISSION_PLUGINS as $permissionPlugin) {
            $permissionTransfer = $I->havePermission(new $permissionPlugin());
            $this->permissionCollectionTransfer->addPermission($permissionTransfer);
        }

        $companyRoleTransfer = $I->haveCompanyRole([
            CompanyRoleTransfer::FK_COMPANY => $this->companyTransfer->getIdCompany(),
            CompanyRoleTransfer::PERMISSION_COLLECTION => $this->permissionCollectionTransfer,
        ]);

        $companyRoleCollectionTransfer = (new CompanyRoleCollectionBuilder())->build()
            ->addRole($companyRoleTransfer);

        $this->companyUserTransfer->setCompanyRoleCollection($companyRoleCollectionTransfer);

        $I->assignCompanyRolesToCompanyUser($this->companyUserTransfer);
    }

    protected function createCompanyBusinessUnit(SelfServicePortalApiTester $I): void
    {
        $this->companyBusinessUnitTransfer = $I->haveCompanyBusinessUnit([
            CompanyBusinessUnitTransfer::FK_COMPANY => $this->companyTransfer->getIdCompany(),
            CompanyBusinessUnitTransfer::ADDRESS_COLLECTION => (new CompanyUnitAddressCollectionTransfer())
                ->addCompanyUnitAddress($this->companyUnitAddressTransfer),
        ]);

        $I->haveCompanyUnitAddressToCompanyBusinessUnitRelation($this->companyBusinessUnitTransfer);
    }

    protected function createAssets(SelfServicePortalApiTester $I): void
    {
        $this->assetTransfer = $I->haveAsset([
            SspAssetTransfer::REFERENCE => 'ASSET-00100001123',
            SspAssetTransfer::EXTERNAL_IMAGE_URL => static::TEST_ASSET_URL,
            SspAssetTransfer::COMPANY_BUSINESS_UNIT => $this->companyBusinessUnitTransfer,
            SspAssetTransfer::SERIAL_NUMBER => 'qweqwe12432rwef34f343f34',
            SspAssetTransfer::NOTE => 'This is a test asset. Note field.',
            SspAssetTransfer::BUSINESS_UNIT_ASSIGNMENTS => [
                [SspAssetBusinessUnitAssignmentTransfer::COMPANY_BUSINESS_UNIT => $this->companyBusinessUnitTransfer],
            ],
        ]);

        $this->secondAssetTransfer = $I->haveAsset([
            SspAssetTransfer::REFERENCE => 'ASSET-00123123123123123',
            SspAssetTransfer::EXTERNAL_IMAGE_URL => 'https://example.com/asset2.pdf',
            SspAssetTransfer::COMPANY_BUSINESS_UNIT => $this->companyBusinessUnitTransfer,
            SspAssetTransfer::SERIAL_NUMBER => 'qweqwe12432rwef34f343f34',
            SspAssetTransfer::NOTE => 'This is a test asset. Note field.',
        ]);
    }
}
