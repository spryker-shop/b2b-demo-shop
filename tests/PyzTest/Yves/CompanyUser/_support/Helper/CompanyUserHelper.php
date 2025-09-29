<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

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

        return $this->createCompanyUser([
            CompanyUserTransfer::CUSTOMER => $customerTransfer,
            CompanyUserTransfer::FK_COMPANY => $companyTransfer->getIdCompany(),
            CompanyUserTransfer::FK_COMPANY_BUSINESS_UNIT => $companyBusinessUnitTransfer->getIdCompanyBusinessUnit(),
            CompanyUserTransfer::COMPANY_ROLE_COLLECTION => (new CompanyRoleCollectionTransfer())->addRole($companyRoleTransfer),
        ]);
    }

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
            if (!in_array($permissionTransfer->getKey(), static::COMPANY_USER_PERMISSIONS_KEY_LIST, true)) {
                continue;
            }

            $permissionCollectionTransfer->addPermission($permissionTransfer);
        }

        return $permissionCollectionTransfer;
    }

    protected function createCompanyRole(array $seed = []): CompanyRoleTransfer
    {
        return $this->getModule('\\' . CompanyRoleHelper::class)
            ->haveCompanyRole($seed);
    }

    protected function createCompany(array $seed = []): CompanyTransfer
    {
        $mailMock = new CompanyMailConnectorToMailFacadeBridge($this->getMailMock());
        $this->setDependency(CompanyMailConnectorDependencyProvider::FACADE_MAIL, $mailMock);

        return $this->getModule('\\' . CompanyHelper::class)->haveCompany($seed + [
                CompanyTransfer::IS_ACTIVE => true,
                CompanyTransfer::STATUS => 'approved',
            ]);
    }

    protected function createCompanyBusinessUnit(array $seed = []): CompanyBusinessUnitTransfer
    {
        return $this->getModule('\\' . CompanyBusinessUnitHelper::class)
            ->haveCompanyBusinessUnit($seed);
    }

    protected function createCompanyUser(array $seed = []): CompanyUserTransfer
    {
        return $this->getModule('\\' . SprykerTestCompanyUserHelper::class)
            ->haveCompanyUser($seed + [
                CompanyUserTransfer::IS_ACTIVE => true,
            ]);
    }

    protected function getPermissionFacade(): PermissionFacadeInterface
    {
        return $this->getLocator()->permission()->facade();
    }

    protected function getPermissionStoragePluginMock(): PermissionStoragePluginInterface
    {
        return Stub::makeEmpty(PermissionStoragePluginInterface::class);
    }

    protected function getMailMock(): MailFacadeInterface
    {
        return Stub::makeEmpty(MailFacadeInterface::class);
    }
}
