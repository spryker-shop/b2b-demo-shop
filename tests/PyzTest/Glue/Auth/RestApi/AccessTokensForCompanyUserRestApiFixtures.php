<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\Auth\RestApi;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use PyzTest\Glue\Auth\AuthRestApiTester;
use SprykerTest\Shared\Testify\Fixtures\FixturesBuilderInterface;
use SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface;

class AccessTokensForCompanyUserRestApiFixtures implements FixturesBuilderInterface, FixturesContainerInterface
{
    protected const TEST_PASSWORD = 'change123';

    protected CompanyUserTransfer $companyUserTransfer;

    protected CompanyUserTransfer $defaultCompanyUserTransfer;

    protected CustomerTransfer $customerTransferWithCompanyUser;

    protected CustomerTransfer $customerTransferWithoutCompanyUser;

    protected CustomerTransfer $customerTransferWithTwoCompanyUsersWithoutDefaultOne;

    protected CustomerTransfer $customerTransferWithTwoCompanyUsersWithDefaultOne;

    public function buildFixtures(AuthRestApiTester $I): FixturesContainerInterface
    {
        $I->haveCompanyMailConnectorToMailDependency();

        $this->createCustomerTransferWithCompanyUser($I);
        $this->createCustomerTransferWithoutCompanyUser($I);
        $this->createCustomerTransferWithTwoCompanyUsersWithoutDefaultOne($I);
        $this->createCustomerTransferWithTwoCompanyUsersWithDefaultOne($I);

        return $this;
    }

    public function getCustomerTransferWithCompanyUser(): CustomerTransfer
    {
        return $this->customerTransferWithCompanyUser;
    }

    public function getCustomerTransferWithoutCompanyUser(): CustomerTransfer
    {
        return $this->customerTransferWithoutCompanyUser;
    }

    public function getCustomerTransferWithTwoCompanyUsersWithoutDefaultOne(): CustomerTransfer
    {
        return $this->customerTransferWithTwoCompanyUsersWithoutDefaultOne;
    }

    public function getCustomerTransferWithTwoCompanyUsersWithDefaultOne(): CustomerTransfer
    {
        return $this->customerTransferWithTwoCompanyUsersWithDefaultOne;
    }

    public function getCompanyUserTransfer(): CompanyUserTransfer
    {
        return $this->companyUserTransfer;
    }

    public function getDefaultCompanyUserTransfer(): CompanyUserTransfer
    {
        return $this->defaultCompanyUserTransfer;
    }

    protected function createCustomerTransferWithCompanyUser(AuthRestApiTester $I): void
    {
        $this->customerTransferWithCompanyUser = $this->createCustomerTransfer($I);
        $this->companyUserTransfer = $this->createCompanyUserTransfer($I, $this->customerTransferWithCompanyUser);
    }

    protected function createCustomerTransferWithoutCompanyUser(AuthRestApiTester $I): void
    {
        $this->customerTransferWithoutCompanyUser = $this->createCustomerTransfer($I);
    }

    protected function createCustomerTransferWithTwoCompanyUsersWithoutDefaultOne(AuthRestApiTester $I): void
    {
        $customerTransfer = $this->createCustomerTransfer($I);

        $this->createCompanyUserTransfer($I, $customerTransfer);
        $this->createCompanyUserTransfer($I, $customerTransfer);

        $this->customerTransferWithTwoCompanyUsersWithoutDefaultOne = $customerTransfer;
    }

    protected function createCustomerTransferWithTwoCompanyUsersWithDefaultOne(AuthRestApiTester $I): void
    {
        $customerTransfer = $this->createCustomerTransfer($I);

        $this->defaultCompanyUserTransfer = $this->createCompanyUserTransfer($I, $customerTransfer, [
            CompanyUserTransfer::IS_DEFAULT => true,
        ]);
        $this->createCompanyUserTransfer($I, $customerTransfer);

        $this->customerTransferWithTwoCompanyUsersWithDefaultOne = $customerTransfer;
    }

    protected function createCustomerTransfer(AuthRestApiTester $I): CustomerTransfer
    {
        $customerTransfer = $I->haveCustomer([
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);

        return $I->confirmCustomer($customerTransfer);
    }

    protected function createCompanyUserTransfer(
        AuthRestApiTester $I,
        CustomerTransfer $customerTransfer,
        array $seed = [],
    ): CompanyUserTransfer {
        $companyTransfer = $I->haveActiveCompany([
            CompanyTransfer::STATUS => 'approved',
        ]);

        $companyBusinessUnitTransfer = $I->haveCompanyBusinessUnit([
            CompanyBusinessUnitTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
        ]);

        return $I->haveCompanyUser($seed + [
            CompanyUserTransfer::CUSTOMER => $customerTransfer,
            CompanyUserTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
            CompanyUserTransfer::FK_COMPANY_BUSINESS_UNIT => $companyBusinessUnitTransfer->getIdCompanyBusinessUnit(),
        ]);
    }
}
