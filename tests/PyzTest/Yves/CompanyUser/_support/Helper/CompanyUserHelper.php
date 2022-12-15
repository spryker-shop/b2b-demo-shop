<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\CompanyUser\Helper;

use Codeception\Module;
use Codeception\Stub;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\PermissionCollectionTransfer;
use Pyz\Zed\Permission\PermissionDependencyProvider;
use Spryker\Zed\CompanyMailConnector\CompanyMailConnectorDependencyProvider;
use Spryker\Zed\CompanyMailConnector\Dependency\Facade\CompanyMailConnectorToMailFacadeBridge;
use Spryker\Zed\Mail\Business\MailFacadeInterface;
use Spryker\Zed\Permission\Business\PermissionFacadeInterface;
use Spryker\Zed\PermissionExtension\Dependency\Plugin\PermissionStoragePluginInterface;
use SprykerTest\Shared\CompanyUser\Helper\CompanyUserHelper as SprykerTestCompanyUserHelper;
use SprykerTest\Shared\Testify\Helper\DependencyHelperTrait;
use SprykerTest\Shared\Testify\Helper\LocatorHelperTrait;
use SprykerTest\Zed\Company\Helper\CompanyHelper;
use SprykerTest\Zed\CompanyBusinessUnit\Helper\CompanyBusinessUnitHelper;
use SprykerTest\Zed\CompanyRole\Helper\CompanyRoleHelper;

class CompanyUserHelper extends Module
{
    use LocatorHelperTrait;
    use DependencyHelperTrait;

    /**
     * @var array
     */
    protected const COMPANY_USER_PERMISSIONS_KEY_LIST = [
        'AddCartItemPermissionPlugin',
        'ChangeCartItemPermissionPlugin',
        'RemoveCartItemPermissionPlugin',
    ];

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function haveRegisteredCompanyUser(CustomerTransfer $customerTransfer): CompanyUserTransfer
    {
        $companyTransfer = $this->createCompany();
        $companyRoleTransfer = $this->createCompanyRole([
            CompanyRoleTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
            CompanyRoleTransfer::PERMISSION_COLLECTION => $this->createPermissionCollectionTransferWithCartPermissions(),
        ]);
        $companyBusinessUnitTransfer = $this->createCompanyBusinessUnit([
            CompanyBusinessUnitTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
        ]);
        $companyUserTransfer = $this->createCompanyUser([
            CompanyUserTransfer::CUSTOMER => $customerTransfer,
            CompanyUserTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
            CompanyUserTransfer::FK_COMPANY_BUSINESS_UNIT => $companyBusinessUnitTransfer->getIdCompanyBusinessUnit(),
            CompanyUserTransfer::COMPANY_ROLE_COLLECTION => (new CompanyRoleCollectionTransfer())->addRole($companyRoleTransfer),
        ]);

        return $companyUserTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\PermissionCollectionTransfer
     */
    protected function createPermissionCollectionTransferWithCartPermissions(): PermissionCollectionTransfer
    {
        $this->setDependency(PermissionDependencyProvider::PLUGINS_PERMISSION_STORAGE, [
            $this->getPermissionStoragePluginMock(),
        ]);

        $availablePermissions = $this->getPermissionFacade()
            ->findMergedRegisteredNonInfrastructuralPermissions()
            ->getPermissions();

        $permissionCollectionTransfer = new PermissionCollectionTransfer();
        foreach ($availablePermissions as $permissionTransfer) {
            if (in_array($permissionTransfer->getKey(), static::COMPANY_USER_PERMISSIONS_KEY_LIST, true)) {
                $permissionCollectionTransfer->addPermission($permissionTransfer);
            }
        }

        return $permissionCollectionTransfer;
    }

    /**
     * @param array $seed
     *
     * @return \Generated\Shared\Transfer\CompanyRoleTransfer
     */
    protected function createCompanyRole(array $seed = []): CompanyRoleTransfer
    {
        return $this->getModule('\\' . CompanyRoleHelper::class)
            ->haveCompanyRole($seed);
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
     * @return \Spryker\Zed\Permission\Business\PermissionFacadeInterface
     */
    protected function getPermissionFacade(): PermissionFacadeInterface
    {
        return $this->getLocator()->permission()->facade();
    }

    /**
     * @return \Spryker\Zed\PermissionExtension\Dependency\Plugin\PermissionStoragePluginInterface
     */
    protected function getPermissionStoragePluginMock(): PermissionStoragePluginInterface
    {
        return Stub::makeEmpty(PermissionStoragePluginInterface::class);
    }

    /**
     * @return \Spryker\Zed\Mail\Business\MailFacadeInterface
     */
    protected function getMailMock(): MailFacadeInterface
    {
        return Stub::makeEmpty(MailFacadeInterface::class);
    }
}
