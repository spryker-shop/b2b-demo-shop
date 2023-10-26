<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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
    /**
     * @var string
     */
    protected const TEST_PASSWORD = 'change123';

    /**
     * @var \Generated\Shared\Transfer\OauthResponseTransfer
     */
    protected OauthResponseTransfer $oauthResponseTransferForCompanyUser;

    /**
     * @var \Generated\Shared\Transfer\OauthResponseTransfer
     */
    protected OauthResponseTransfer $oauthResponseTransferForNonCompanyUser;

    /**
     * @var \Generated\Shared\Transfer\OauthResponseTransfer
     */
    protected OauthResponseTransfer $oauthResponseTransferForCustomerWithTwoCompanyUsers;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected CompanyUserTransfer $nonDefaultCompanyUserTransfer;

    /**
     * @param \PyzTest\Glue\CompanyUserAuth\CompanyUserAuthRestApiTester $I
     *
     * @return \SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface
     */
    public function buildFixtures(CompanyUserAuthRestApiTester $I): FixturesContainerInterface
    {
        $I->haveCompanyMailConnectorToMailDependency();

        $this->oauthResponseTransferForCompanyUser = $this->createOauthResponseForCompanyUser($I);
        $this->oauthResponseTransferForNonCompanyUser = $this->createOauthResponseForNotCompanyUser($I);
        $this->oauthResponseTransferForCustomerWithTwoCompanyUsers = $this->createOauthResponseForCustomerWithTwoCompanyUsers($I);

        return $this;
    }

    /**
     * @return \Generated\Shared\Transfer\OauthResponseTransfer
     */
    public function getOauthResponseTransferForCompanyUser(): OauthResponseTransfer
    {
        return $this->oauthResponseTransferForCompanyUser;
    }

    /**
     * @return \Generated\Shared\Transfer\OauthResponseTransfer
     */
    public function getOauthResponseTransferForNonCompanyUser(): OauthResponseTransfer
    {
        return $this->oauthResponseTransferForNonCompanyUser;
    }

    /**
     * @return \Generated\Shared\Transfer\OauthResponseTransfer
     */
    public function getOauthResponseTransferForCustomerWithTwoCompanyUsers(): OauthResponseTransfer
    {
        return $this->oauthResponseTransferForCustomerWithTwoCompanyUsers;
    }

    /**
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function getNonDefaultCompanyUserTransfer(): CompanyUserTransfer
    {
        return $this->nonDefaultCompanyUserTransfer;
    }

    /**
     * @param \PyzTest\Glue\CompanyUserAuth\CompanyUserAuthRestApiTester $I
     *
     * @return \Generated\Shared\Transfer\OauthResponseTransfer
     */
    protected function createOauthResponseForCompanyUser(CompanyUserAuthRestApiTester $I): OauthResponseTransfer
    {
        $customerTransfer = $this->createCustomerWithCompanyUser($I);
        $customerTransfer = $I->confirmCustomer($customerTransfer);

        return $I->haveAuthorizationToGlue($customerTransfer);
    }

    /**
     * @param \PyzTest\Glue\CompanyUserAuth\CompanyUserAuthRestApiTester $I
     *
     * @return \Generated\Shared\Transfer\OauthResponseTransfer
     */
    protected function createOauthResponseForNotCompanyUser(CompanyUserAuthRestApiTester $I): OauthResponseTransfer
    {
        $customerTransfer = $this->createCustomer($I);
        $customerTransfer = $I->confirmCustomer($customerTransfer);

        return $I->haveAuthorizationToGlue($customerTransfer);
    }

    /**
     * @param \PyzTest\Glue\CompanyUserAuth\CompanyUserAuthRestApiTester $I
     *
     * @return \Generated\Shared\Transfer\OauthResponseTransfer
     */
    protected function createOauthResponseForCustomerWithTwoCompanyUsers(
        CompanyUserAuthRestApiTester $I,
    ): OauthResponseTransfer {
        $customerTransfer = $this->createCustomerWithTwoCompanyUsers($I);
        $customerTransfer = $I->confirmCustomer($customerTransfer);

        return $I->haveAuthorizationToGlue($customerTransfer);
    }

    /**
     * @param \PyzTest\Glue\CompanyUserAuth\CompanyUserAuthRestApiTester $I
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    protected function createCustomerWithCompanyUser(CompanyUserAuthRestApiTester $I): CustomerTransfer
    {
        $customerTransfer = $I->haveCustomer([
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);

        $this->createCompanyUser($I, $customerTransfer);

        return $customerTransfer;
    }

    /**
     * @param \PyzTest\Glue\CompanyUserAuth\CompanyUserAuthRestApiTester $I
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
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

    /**
     * @param \PyzTest\Glue\CompanyUserAuth\CompanyUserAuthRestApiTester $I
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    protected function createCustomer(CompanyUserAuthRestApiTester $I): CustomerTransfer
    {
        return $I->haveCustomer([
            CustomerTransfer::PASSWORD => static::TEST_PASSWORD,
            CustomerTransfer::NEW_PASSWORD => static::TEST_PASSWORD,
        ]);
    }

    /**
     * @param \PyzTest\Glue\CompanyUserAuth\CompanyUserAuthRestApiTester $I
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param array $seed
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
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
