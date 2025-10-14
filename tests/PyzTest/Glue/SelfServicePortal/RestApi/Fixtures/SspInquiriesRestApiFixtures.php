<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\SelfServicePortal\RestApi\Fixtures;

use Generated\Shared\DataBuilder\CompanyRoleCollectionBuilder;
use Generated\Shared\DataBuilder\PermissionCollectionBuilder;
use Generated\Shared\DataBuilder\QuoteBuilder;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\PermissionCollectionTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\SspAssetBusinessUnitAssignmentTransfer;
use Generated\Shared\Transfer\SspAssetTransfer;
use Generated\Shared\Transfer\SspInquiryTransfer;
use Generated\Shared\Transfer\StateMachineItemStateTransfer;
use Generated\Shared\Transfer\StateMachineProcessTransfer;
use PyzTest\Glue\SelfServicePortal\SelfServicePortalApiTester;
use SprykerFeature\Shared\SelfServicePortal\Plugin\Permission\CreateSspInquiryPermissionPlugin;
use SprykerFeature\Shared\SelfServicePortal\Plugin\Permission\ViewBusinessUnitSspInquiryPermissionPlugin;
use SprykerFeature\Shared\SelfServicePortal\Plugin\Permission\ViewCompanySspInquiryPermissionPlugin;
use SprykerTest\Shared\Testify\Fixtures\FixturesBuilderInterface;
use SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface;

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
class SspInquiriesRestApiFixtures implements FixturesBuilderInterface, FixturesContainerInterface
{
    protected const TEST_USERNAME = 'SspInquiriesRestApiFixtures';

    protected const TEST_PASSWORD = 'change123';

    protected const TEST_COMPANY_NAME = 'Test Inquiries Company';

    protected const PRICE_MODE_GROSS = 'GROSS_MODE';

    protected const STATE_MACHINE_NAME = 'DummyPayment01';

    public const PERMISSION_PLUGINS = [
        ViewBusinessUnitSspInquiryPermissionPlugin::class,
        ViewCompanySspInquiryPermissionPlugin::class,
        CreateSspInquiryPermissionPlugin::class,
    ];

    protected CustomerTransfer $customerTransfer;

    protected CompanyTransfer $companyTransfer;

    protected CompanyUserTransfer $companyUserTransfer;

    protected SspInquiryTransfer $inquiryTransfer;

    protected SspAssetTransfer $assetTransfer;

    protected SaveOrderTransfer $saveOrderTransfer;

    protected CompanyBusinessUnitTransfer $companyBusinessUnitTransfer;

    protected CompanyUnitAddressTransfer $companyUnitAddressTransfer;

    protected PermissionCollectionTransfer $permissionCollectionTransfer;

    protected SspInquiryTransfer $inquiryWithAssetTransfer;

    protected SspInquiryTransfer $inquiryWithOrderTransfer;

    public function buildFixtures(SelfServicePortalApiTester $I): FixturesContainerInterface
    {
        $this->createCompany($I);
        $this->createCustomer($I);
        $this->createCompanyBusinessUnit($I);
        $this->createCompanyUser($I);
        $this->createAsset($I);
        $this->createOrderWithProductConcretes($I);
        $this->createInquiries($I);

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

    public function getInquiryTransfer(): SspInquiryTransfer
    {
        return $this->inquiryTransfer;
    }

    public function getInquiryWithAssetTransfer(): SspInquiryTransfer
    {
        return $this->inquiryWithAssetTransfer;
    }

    public function getInquiryWithOrderTransfer(): SspInquiryTransfer
    {
        return $this->inquiryWithOrderTransfer;
    }

    public function getAssetTransfer(): SspAssetTransfer
    {
        return $this->assetTransfer;
    }

    public function getSaveOrderTransfer(): SaveOrderTransfer
    {
        return $this->saveOrderTransfer;
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

    protected function createInquiries(SelfServicePortalApiTester $I): void
    {
        $sspInquiryStateMachineProcess = $I->haveStateMachineProcess([
            StateMachineProcessTransfer::STATE_MACHINE_NAME => 'test_ssp_inquiry',
        ]);

        $I->haveStateMachineItemState([
            StateMachineItemStateTransfer::FK_STATE_MACHINE_PROCESS => $sspInquiryStateMachineProcess->getIdStateMachineProcess(),
            StateMachineItemStateTransfer::NAME => 'test_initial_state',
        ]);

         $this->inquiryTransfer = $I->haveSspInquiry([
             SspInquiryTransfer::SUBJECT => 'Test inquiry subject 1',
             SspInquiryTransfer::DESCRIPTION => 'This is a test inquiry description 1',
             SspInquiryTransfer::TYPE => 'general',
             SspInquiryTransfer::STATUS => 'test_initial_state',
             SspInquiryTransfer::COMPANY_USER => $this->companyUserTransfer,
         ]);

         $this->inquiryWithAssetTransfer = $I->haveSspInquiry([
             SspInquiryTransfer::SUBJECT => 'Test inquiry subject 2',
             SspInquiryTransfer::DESCRIPTION => 'This is a test inquiry description 2',
             SspInquiryTransfer::TYPE => 'ssp_asset',
             SspInquiryTransfer::STATUS => 'test_initial_state',
             SspInquiryTransfer::SSP_ASSET => $this->assetTransfer,
             SspInquiryTransfer::COMPANY_USER => $this->companyUserTransfer,
         ]);

         $this->inquiryWithOrderTransfer = $I->haveSspInquiry([
             SspInquiryTransfer::SUBJECT => 'Test inquiry subject 3',
             SspInquiryTransfer::DESCRIPTION => 'This is a test inquiry description 3',
             SspInquiryTransfer::TYPE => 'order',
             SspInquiryTransfer::STATUS => 'test_initial_state',
             SspInquiryTransfer::COMPANY_USER => $this->companyUserTransfer,
             SspInquiryTransfer::ORDER => (new OrderTransfer())->setIdSalesOrder($this->saveOrderTransfer->getIdSalesOrder())
                 ->setOrderReference($this->saveOrderTransfer->getOrderReference()),
         ]);
    }

    protected function createAsset(SelfServicePortalApiTester $I): void
    {
        $this->assetTransfer = $I->haveAsset([
            SspAssetTransfer::REFERENCE => 'ASSET-00100001123',
            SspAssetTransfer::EXTERNAL_IMAGE_URL => 'https://example.com/asset.pdf',
            SspAssetTransfer::COMPANY_BUSINESS_UNIT => $this->companyBusinessUnitTransfer,
            SspAssetTransfer::SERIAL_NUMBER => 'test-serial-123',
            SspAssetTransfer::NOTE => 'Test asset for inquiry testing',
            SspAssetTransfer::BUSINESS_UNIT_ASSIGNMENTS => [
                [SspAssetBusinessUnitAssignmentTransfer::COMPANY_BUSINESS_UNIT => $this->companyBusinessUnitTransfer],
            ],
        ]);
    }

    protected function createOrderWithProductConcretes(SelfServicePortalApiTester $I): void
    {
        $product1Transfer = $I->haveProductWithPriceAndStock();
        $product2Transfer = $I->haveProductWithPriceAndStock();
        $quoteTransfer = (new QuoteBuilder())
            ->withCustomer([CustomerTransfer::CUSTOMER_REFERENCE => $this->customerTransfer->getCustomerReference()])
            ->withItem([
                ItemTransfer::SKU => $product1Transfer->getSkuOrFail(),
                ItemTransfer::QUANTITY => 1,
            ])
            ->withItem([
                ItemTransfer::SKU => $product2Transfer->getSkuOrFail(),
                ItemTransfer::QUANTITY => 2,
            ])
            ->withTotals()
            ->withShippingAddress()
            ->withBillingAddress()
            ->withCurrency()
            ->withPayment()
            ->build();

        $quoteTransfer->setPriceMode(static::PRICE_MODE_GROSS);

        $this->saveOrderTransfer = $I->haveOrderFromQuote($quoteTransfer, static::STATE_MACHINE_NAME);
    }
}
