<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\Checkout\RestApi\Fixtures;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\PermissionCollectionTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;
use PyzTest\Glue\Checkout\CheckoutApiTester;
use Spryker\Zed\Company\CompanyDependencyProvider;
use SprykerTest\Shared\Shipment\Helper\ShipmentMethodDataHelper;
use SprykerTest\Shared\Testify\Fixtures\FixturesBuilderInterface;
use SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface;

class CompanyBusinessUnitAddressCheckoutRestApiFixtures implements FixturesBuilderInterface, FixturesContainerInterface
{
    protected const TEST_USERNAME = 'CompanyBUAddressCheckoutRestApiFixtures';

    protected const TEST_PASSWORD = 'change123';

    protected CustomerTransfer $customerTransfer;

    protected CompanyUserTransfer $companyUserTransfer;

    protected CompanyUnitAddressTransfer $companyUnitAddressTransfer;

    protected ShipmentMethodTransfer $shipmentMethodTransfer;

    public function getCustomerTransfer(): CustomerTransfer
    {
        return $this->customerTransfer;
    }

    public function getCompanyUserTransfer(): CompanyUserTransfer
    {
        return $this->companyUserTransfer;
    }

    public function getCompanyUnitAddressTransfer(): CompanyUnitAddressTransfer
    {
        return $this->companyUnitAddressTransfer;
    }

    public function getShipmentMethodTransfer(): ShipmentMethodTransfer
    {
        return $this->shipmentMethodTransfer;
    }

    public function buildFixtures(CheckoutApiTester $I): FixturesContainerInterface
    {
        $I->truncateSalesOrderThresholds();

        $customerTransfer = $I->haveCustomer([
            CustomerTransfer::USERNAME => static::TEST_USERNAME,
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);

        $this->customerTransfer = $I->confirmCustomer($customerTransfer);
        $this->buildCompanyUserAccount($I, $this->customerTransfer);
        $this->buildShipmentMethod($I);

        return $this;
    }

    protected function buildCompanyUserAccount(
        CheckoutApiTester $I,
        CustomerTransfer $customerTransfer,
    ): void {
        $this->mockCompanyPostSavePlugins($I);

        $companyTransfer = $I->haveActiveCompany([
            CompanyTransfer::STATUS => 'approved',
        ]);

        $this->companyUnitAddressTransfer = $I->haveCompanyUnitAddress([
            CompanyUnitAddressTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
        ]);

        $companyBusinessUnitTransfer = $I->haveCompanyBusinessUnit([
            CompanyBusinessUnitTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
            CompanyBusinessUnitTransfer::ADDRESS_COLLECTION => (new CompanyUnitAddressCollectionTransfer())
                ->addCompanyUnitAddress($this->companyUnitAddressTransfer),
        ]);

        $I->haveCompanyUnitAddressToCompanyBusinessUnitRelation($companyBusinessUnitTransfer);

        $permissionCollectionTransfer = (new PermissionCollectionTransfer())->addPermission(
            $I->getLocator()->permission()->facade()->findPermissionByKey('PlaceOrderPermissionPlugin'),
        );

        $companyRoleTransfer = $I->haveCompanyRole([
            CompanyRoleTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
            CompanyRoleTransfer::PERMISSION_COLLECTION => $permissionCollectionTransfer,
        ]);

        $this->companyUserTransfer = $I->haveCompanyUser([
            CompanyUserTransfer::CUSTOMER => $customerTransfer,
            CompanyUserTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
            CompanyUserTransfer::FK_COMPANY_BUSINESS_UNIT => $companyBusinessUnitTransfer->getIdCompanyBusinessUnit(),
            CompanyUserTransfer::COMPANY_ROLE_COLLECTION => (new CompanyRoleCollectionTransfer())->addRole($companyRoleTransfer),
        ]);
        $I->assignCompanyRolesToCompanyUser($this->companyUserTransfer);
    }

    protected function buildShipmentMethod(CheckoutApiTester $I): void
    {
        $this->shipmentMethodTransfer = $I->haveShipmentMethod(
            [
                ShipmentMethodTransfer::CARRIER_NAME => 'Spryker Dummy Shipment',
                ShipmentMethodTransfer::NAME => 'Standard',
            ],
            [],
            ShipmentMethodDataHelper::DEFAULT_PRICE_LIST,
            [
                $I->getStoreFacade()->getCurrentStore()->getIdStore(),
            ],
        );
    }

    protected function mockCompanyPostSavePlugins(CheckoutApiTester $I): void
    {
        $I->setDependency(CompanyDependencyProvider::COMPANY_POST_SAVE_PLUGINS, []);
    }
}
