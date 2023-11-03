<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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
    /**
     * @var string
     */
    protected const TEST_PASSWORD = 'change123';

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected CompanyUserTransfer $companyUserTransfer;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected CompanyUserTransfer $defaultCompanyUserTransfer;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer
     */
    protected CustomerTransfer $customerTransferWithCompanyUser;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer
     */
    protected CustomerTransfer $customerTransferWithoutCompanyUser;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer
     */
    protected CustomerTransfer $customerTransferWithTwoCompanyUsersWithoutDefaultOne;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer
     */
    protected CustomerTransfer $customerTransferWithTwoCompanyUsersWithDefaultOne;

    /**
     * @param \PyzTest\Glue\Auth\AuthRestApiTester $I
     *
     * @return \SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface
     */
    public function buildFixtures(AuthRestApiTester $I): FixturesContainerInterface
    {
        $I->haveCompanyMailConnectorToMailDependency();

        $this->createCustomerTransferWithCompanyUser($I);
        $this->createCustomerTransferWithoutCompanyUser($I);
        $this->createCustomerTransferWithTwoCompanyUsersWithoutDefaultOne($I);
        $this->createCustomerTransferWithTwoCompanyUsersWithDefaultOne($I);

        return $this;
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function getCustomerTransferWithCompanyUser(): CustomerTransfer
    {
        return $this->customerTransferWithCompanyUser;
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function getCustomerTransferWithoutCompanyUser(): CustomerTransfer
    {
        return $this->customerTransferWithoutCompanyUser;
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function getCustomerTransferWithTwoCompanyUsersWithoutDefaultOne(): CustomerTransfer
    {
        return $this->customerTransferWithTwoCompanyUsersWithoutDefaultOne;
    }

    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function getCustomerTransferWithTwoCompanyUsersWithDefaultOne(): CustomerTransfer
    {
        return $this->customerTransferWithTwoCompanyUsersWithDefaultOne;
    }

    /**
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function getCompanyUserTransfer(): CompanyUserTransfer
    {
        return $this->companyUserTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function getDefaultCompanyUserTransfer(): CompanyUserTransfer
    {
        return $this->defaultCompanyUserTransfer;
    }

    /**
     * @param \PyzTest\Glue\Auth\AuthRestApiTester $I
     *
     * @return void
     */
    protected function createCustomerTransferWithCompanyUser(AuthRestApiTester $I): void
    {
        $this->customerTransferWithCompanyUser = $this->createCustomerTransfer($I);
        $this->companyUserTransfer = $this->createCompanyUserTransfer($I, $this->customerTransferWithCompanyUser);
    }

    /**
     * @param \PyzTest\Glue\Auth\AuthRestApiTester $I
     *
     * @return void
     */
    protected function createCustomerTransferWithoutCompanyUser(AuthRestApiTester $I): void
    {
        $this->customerTransferWithoutCompanyUser = $this->createCustomerTransfer($I);
    }

    /**
     * @param \PyzTest\Glue\Auth\AuthRestApiTester $I
     *
     * @return void
     */
    protected function createCustomerTransferWithTwoCompanyUsersWithoutDefaultOne(AuthRestApiTester $I): void
    {
        $customerTransfer = $this->createCustomerTransfer($I);

        $this->createCompanyUserTransfer($I, $customerTransfer);
        $this->createCompanyUserTransfer($I, $customerTransfer);

        $this->customerTransferWithTwoCompanyUsersWithoutDefaultOne = $customerTransfer;
    }

    /**
     * @param \PyzTest\Glue\Auth\AuthRestApiTester $I
     *
     * @return void
     */
    protected function createCustomerTransferWithTwoCompanyUsersWithDefaultOne(AuthRestApiTester $I): void
    {
        $customerTransfer = $this->createCustomerTransfer($I);

        $this->defaultCompanyUserTransfer = $this->createCompanyUserTransfer($I, $customerTransfer, [
            CompanyUserTransfer::IS_DEFAULT => true,
        ]);
        $this->createCompanyUserTransfer($I, $customerTransfer);

        $this->customerTransferWithTwoCompanyUsersWithDefaultOne = $customerTransfer;
    }

    /**
     * @param \PyzTest\Glue\Auth\AuthRestApiTester $I
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    protected function createCustomerTransfer(AuthRestApiTester $I): CustomerTransfer
    {
        $customerTransfer = $I->haveCustomer([
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);

        return $I->confirmCustomer($customerTransfer);
    }

    /**
     * @param \PyzTest\Glue\Auth\AuthRestApiTester $I
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param array $seed
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
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
