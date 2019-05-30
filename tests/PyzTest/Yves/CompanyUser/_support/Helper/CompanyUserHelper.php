<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\CompanyUser\Helper;

use Codeception\Module;
use Codeception\Util\Stub;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\CompanyMailConnector\CompanyMailConnectorDependencyProvider;
use Spryker\Zed\CompanyMailConnector\Dependency\Facade\CompanyMailConnectorToMailFacadeBridge;
use Spryker\Zed\Mail\Business\MailFacadeInterface;
use SprykerTest\Shared\CompanyUser\Helper\CompanyUserHelper as SprykerTestCompanyUserHelper;
use SprykerTest\Shared\Testify\Helper\DependencyHelperTrait;
use SprykerTest\Zed\Company\Helper\CompanyHelper;
 use SprykerTest\Zed\CompanyBusinessUnit\Helper\CompanyBusinessUnitHelper;

class CompanyUserHelper extends Module
{
    use DependencyHelperTrait;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function haveRegisteredCompanyUser(CustomerTransfer $customerTransfer): CompanyUserTransfer
    {
        $companyTransfer = $this->createCompany();

        $companyBusinessUnitTransfer = $this->createCompanyBusinessUnit([
            CompanyBusinessUnitTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
        ]);
        $companyUserTransfer = $this->createCompanyUser([
            CompanyUserTransfer::CUSTOMER => $customerTransfer,
            CompanyUserTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
            CompanyUserTransfer::FK_COMPANY_BUSINESS_UNIT => $companyBusinessUnitTransfer->getIdCompanyBusinessUnit(),
        ]);

        return $companyUserTransfer;
    }

    /**
     * @param array $seed
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    protected function createCompany(array $seed = []): CompanyTransfer
    {
        $mailMock = new CompanyMailConnectorToMailFacadeBridge($this->getMailMock());
        $this->setDependency(CompanyMailConnectorDependencyProvider::FACADE_MAIL, $mailMock);

        return $this->getModule('\\' . CompanyHelper::class)->haveCompany($seed + [
                CompanyTransfer::IS_ACTIVE => true,
                CompanyTransfer::STATUS => 'approved',
            ]);
    }

    /**
     * @param array $seed
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected function createCompanyBusinessUnit(array $seed = []): CompanyBusinessUnitTransfer
    {
        return $this->getModule('\\' . CompanyBusinessUnitHelper::class)
            ->haveCompanyBusinessUnit($seed);
    }

    /**
     * @param array $seed
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected function createCompanyUser(array $seed = []): CompanyUserTransfer
    {
        return $this->getModule('\\' . SprykerTestCompanyUserHelper::class)
            ->haveCompanyUser($seed + [
                CompanyUserTransfer::IS_ACTIVE => true,
            ]);
    }

    /**
     * @return object|\Spryker\Zed\Mail\Business\MailFacadeInterface
     */
    protected function getMailMock()
    {
        return Stub::makeEmpty(MailFacadeInterface::class);
    }
}
