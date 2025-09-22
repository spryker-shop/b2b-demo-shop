<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\SelfServicePortal\RestApi\Fixtures;

use Generated\Shared\DataBuilder\CompanyRoleCollectionBuilder;
use Generated\Shared\DataBuilder\PermissionCollectionBuilder;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\SalesProductClassTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderQuery;
use PyzTest\Glue\SelfServicePortal\SelfServicePortalApiTester;
use Spryker\Zed\CompanySalesConnector\Communication\Plugin\Permission\SeeCompanyOrdersPermissionPlugin;
use SprykerTest\Shared\Testify\Fixtures\FixturesBuilderInterface;
use SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface;

class SspServicesRestApiFixtures implements FixturesBuilderInterface, FixturesContainerInterface
{
    protected const TEST_USERNAME = 'SspServicesRestApiFixtures';

    protected const TEST_USERNAME_WITH_SEE_COMPANY_ORDERS_PERMISSION = 'SspServicesRestApiFixturesWithSeeCompanyOrdersPermission';

    protected const TEST_USERNAME_WITH_BUSINESS_UNIT_ORDER_VIEW_PERMISSION = 'SspServicesRestApiFixturesWithBusinessUnitOrderViewPermission';

    protected const TEST_PASSWORD = 'change123';

    protected const STATE_MACHINE_NAME = 'DummyPayment01';

    protected const TEST_COMPANY_NAME = 'Test Company Services';

    /**
     * @uses \SprykerFeature\Shared\SelfServicePortal\SelfServicePortalConfig::getServiceProductClassName()
     *
     * @var string
     */
    protected const DEFAULT_PRODUCT_CLASS_NAME = 'Service';

    protected CustomerTransfer $customerTransfer;

    protected CompanyTransfer $companyTransfer;

    protected CompanyBusinessUnitTransfer $companyBusinessUnitTransfer;

    protected CompanyUserTransfer $companyUserWithCompanyOrderViewPermission;

    protected CompanyUserTransfer $companyUserWithCompanyUserOrderViewPermission;

    protected CustomerTransfer $customerTransferWithCompanyOrderViewPermission;

    public function buildFixtures(SelfServicePortalApiTester $I): FixturesContainerInterface
    {
        $this->createCompany($I);
        $this->createCustomer($I);
        $this->createCustomerWithCompanyOrderViewPermission($I);
        $this->createCompanyBusinessUnit($I);
        $this->createCompanyUserWithCompanyOrderViewPermission($I);
        $this->createCompanyUserWithCompanyUser($I);
        $this->haveCompanyUserOrderWithService($I, $this->companyUserWithCompanyOrderViewPermission);
        $this->haveCompanyUserOrderWithService($I, $this->companyUserWithCompanyUserOrderViewPermission);

        return $this;
    }

    public function getCustomerTransfer(): CustomerTransfer
    {
        return $this->customerTransfer;
    }

    public function getCustomerWithCompanyOrderViewPermissionTransfer(): CustomerTransfer
    {
        return $this->customerTransferWithCompanyOrderViewPermission;
    }

    public function getCompanyTransfer(): CompanyTransfer
    {
        return $this->companyTransfer;
    }

    protected function haveCompanyUserOrderWithService(
        SelfServicePortalApiTester $I,
        CompanyUserTransfer $companyUserTransfer,
    ): void {
        $saveOrderTransfer = $I->haveOrder($companyUserTransfer->toArray(), static::STATE_MACHINE_NAME);
        $spySalesOrder = SpySalesOrderQuery::create()->findPk($saveOrderTransfer->getIdSalesOrderOrFail());
        $spySalesOrder->setCompanyBusinessUnitUuid($this->companyBusinessUnitTransfer->getUuid());
        $spySalesOrder->setCompanyUuid($this->companyTransfer->getUuid());
        $spySalesOrder->setCustomerReference($companyUserTransfer->getCustomer()->getCustomerReference());
        $spySalesOrder->save();

        $salesOrderItemEntity = $I->createSalesOrderItemForOrder(
            $saveOrderTransfer->getIdSalesOrderOrFail(),
            ['process' => static::STATE_MACHINE_NAME],
        );
        $idSalesOrderItem = $salesOrderItemEntity->getIdSalesOrderItem();

        $salesProductClassTransfer = $I->haveSalesProductClass([SalesProductClassTransfer::NAME => static::DEFAULT_PRODUCT_CLASS_NAME]);
        $I->haveSalesOrderItemToProductClass(
            $idSalesOrderItem,
            $salesProductClassTransfer->getIdSalesProductClassOrFail(),
        );
    }

    protected function createCompany(SelfServicePortalApiTester $I): void
    {
        $this->companyTransfer = $I->haveCompany([
            CompanyTransfer::NAME => static::TEST_COMPANY_NAME,
            CompanyTransfer::STATUS => 'approved',
            CompanyTransfer::IS_ACTIVE => true,
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

    protected function createCustomerWithCompanyOrderViewPermission(SelfServicePortalApiTester $I): void
    {
        $customerTransfer = $I->haveCustomer([
            CustomerTransfer::USERNAME => static::TEST_USERNAME_WITH_SEE_COMPANY_ORDERS_PERMISSION,
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);

        $this->customerTransferWithCompanyOrderViewPermission = $I->confirmCustomer($customerTransfer);
    }

    protected function createCompanyUserWithCompanyOrderViewPermission(SelfServicePortalApiTester $I): void
    {
        $this->companyUserWithCompanyOrderViewPermission = $I->haveCompanyUser([
            CompanyUserTransfer::CUSTOMER => $this->customerTransferWithCompanyOrderViewPermission,
            CompanyUserTransfer::FK_COMPANY => $this->companyTransfer->getIdCompany(),
            CompanyUserTransfer::FK_COMPANY_BUSINESS_UNIT => $this->companyBusinessUnitTransfer->getIdCompanyBusinessUnit(),
        ]);

        $permissionCollectionTransfer = (new PermissionCollectionBuilder())->build();

        $permissionTransfer = $I->havePermission(new SeeCompanyOrdersPermissionPlugin());
        $permissionCollectionTransfer->addPermission($permissionTransfer);

        $companyRoleTransfer = $I->haveCompanyRole([
            CompanyRoleTransfer::FK_COMPANY => $this->companyTransfer->getIdCompany(),
            CompanyRoleTransfer::PERMISSION_COLLECTION => $permissionCollectionTransfer,
        ]);

        $companyRoleCollectionTransfer = (new CompanyRoleCollectionBuilder())->build()
            ->addRole($companyRoleTransfer);

        $this->companyUserWithCompanyOrderViewPermission->setCompanyRoleCollection($companyRoleCollectionTransfer);

        $I->assignCompanyRolesToCompanyUser($this->companyUserWithCompanyOrderViewPermission);
    }

    protected function createCompanyUserWithCompanyUser(SelfServicePortalApiTester $I): void
    {
        $this->companyUserWithCompanyUserOrderViewPermission = $I->haveCompanyUser([
            CompanyUserTransfer::CUSTOMER => $this->customerTransfer,
            CompanyUserTransfer::FK_COMPANY => $this->companyTransfer->getIdCompany(),
            CompanyUserTransfer::FK_COMPANY_BUSINESS_UNIT => $this->companyBusinessUnitTransfer->getIdCompanyBusinessUnit(),
        ]);
    }

    protected function createCompanyBusinessUnit(SelfServicePortalApiTester $I): void
    {
        $this->companyBusinessUnitTransfer = $I->haveCompanyBusinessUnit([
            CompanyBusinessUnitTransfer::FK_COMPANY => $this->companyTransfer->getIdCompany(),
        ]);

        $I->haveCompanyUnitAddressToCompanyBusinessUnitRelation($this->companyBusinessUnitTransfer);
    }
}
