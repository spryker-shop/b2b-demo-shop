<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Glue\CompanyUserAuth\RestApi;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OauthResponseTransfer;
use PyzTest\Glue\CompanyUserAuth\CompanyUserAuthRestApiTester;
use SprykerTest\Shared\Testify\Fixtures\FixturesBuilderInterface;
use SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface;

class CompanyUserAuthAccessTokensRestApiFixtures implements FixturesBuilderInterface, FixturesContainerInterface
{
    protected const TEST_PASSWORD = 'change123';

    protected OauthResponseTransfer $oauthResponseTransferForCompanyUser;

    protected OauthResponseTransfer $oauthResponseTransferForNonCompanyUser;

    protected OauthResponseTransfer $oauthResponseTransferForCustomerWithTwoCompanyUsers;

    protected CompanyUserTransfer $nonDefaultCompanyUserTransfer;

    public function buildFixtures(CompanyUserAuthRestApiTester $I): FixturesContainerInterface
    {
        $I->haveCompanyMailConnectorToMailDependency();

        $this->oauthResponseTransferForCompanyUser = $this->createOauthResponseForCompanyUser($I);
        $this->oauthResponseTransferForNonCompanyUser = $this->createOauthResponseForNotCompanyUser($I);
        $this->oauthResponseTransferForCustomerWithTwoCompanyUsers = $this->createOauthResponseForCustomerWithTwoCompanyUsers($I);

        return $this;
    }

    public function getOauthResponseTransferForCompanyUser(): OauthResponseTransfer
    {
        return $this->oauthResponseTransferForCompanyUser;
    }

    public function getOauthResponseTransferForNonCompanyUser(): OauthResponseTransfer
    {
        return $this->oauthResponseTransferForNonCompanyUser;
    }

    public function getOauthResponseTransferForCustomerWithTwoCompanyUsers(): OauthResponseTransfer
    {
        return $this->oauthResponseTransferForCustomerWithTwoCompanyUsers;
    }

    public function getNonDefaultCompanyUserTransfer(): CompanyUserTransfer
    {
        return $this->nonDefaultCompanyUserTransfer;
    }

    protected function createOauthResponseForCompanyUser(CompanyUserAuthRestApiTester $I): OauthResponseTransfer
    {
        $customerTransfer = $this->createCustomerWithCompanyUser($I);
        $customerTransfer = $I->confirmCustomer($customerTransfer);

        return $I->haveAuthorizationToGlue($customerTransfer);
    }

    protected function createOauthResponseForNotCompanyUser(CompanyUserAuthRestApiTester $I): OauthResponseTransfer
    {
        $customerTransfer = $this->createCustomer($I);
        $customerTransfer = $I->confirmCustomer($customerTransfer);

        return $I->haveAuthorizationToGlue($customerTransfer);
    }

    protected function createOauthResponseForCustomerWithTwoCompanyUsers(
        CompanyUserAuthRestApiTester $I,
    ): OauthResponseTransfer {
        $customerTransfer = $this->createCustomerWithTwoCompanyUsers($I);
        $customerTransfer = $I->confirmCustomer($customerTransfer);

        return $I->haveAuthorizationToGlue($customerTransfer);
    }

    protected function createCustomerWithCompanyUser(CompanyUserAuthRestApiTester $I): CustomerTransfer
    {
        $customerTransfer = $I->haveCustomer([
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);

        $this->createCompanyUser($I, $customerTransfer);

        return $customerTransfer;
    }

    protected function createCustomerWithTwoCompanyUsers(CompanyUserAuthRestApiTester $I): CustomerTransfer
    {
        $customerTransfer = $I->haveCustomer([
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);

        $this->createCompanyUser($I, $customerTransfer, [
            CompanyUserTransfer::IS_DEFAULT => true,
        ]);

        $this->nonDefaultCompanyUserTransfer = $this->createCompanyUser($I, $customerTransfer);

        return $customerTransfer;
    }

    protected function createCustomer(CompanyUserAuthRestApiTester $I): CustomerTransfer
    {
        return $I->haveCustomer([
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);
    }

    protected function createCompanyUser(
        CompanyUserAuthRestApiTester $I,
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
