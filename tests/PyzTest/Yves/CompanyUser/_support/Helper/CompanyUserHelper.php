<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\CompanyUser\Helper;

use Codeception\Module;
use Codeception\Util\Stub;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\PermissionCollectionTransfer;
use Generated\Shared\Transfer\PermissionTransfer;
use Spryker\Zed\CompanyMailConnector\CompanyMailConnectorDependencyProvider;
use Spryker\Zed\CompanyMailConnector\Dependency\Facade\CompanyMailConnectorToMailFacadeBridge;
use Spryker\Zed\Mail\Business\MailFacadeInterface;
use SprykerTest\Shared\CompanyUser\Helper\CompanyUserHelper as SprykerTestCompanyUserHelper;
use SprykerTest\Shared\Testify\Helper\DependencyHelperTrait;
use SprykerTest\Shared\Testify\Helper\LocatorHelperTrait;
use SprykerTest\Zed\Company\Helper\CompanyHelper;
use SprykerTest\Zed\CompanyBusinessUnit\Helper\CompanyBusinessUnitHelper;

class CompanyUserHelper extends Module
{
    use LocatorHelperTrait;
    use DependencyHelperTrait;

    protected const COMPANY_USER_PERMISSIONS_KEY_LIST = [
        'AddCartItemPermissionPlugin',
        'ChangeCartItemPermissionPlugin',
        'RemoveCartItemPermissionPlugin',
        'AlterCartUpToAmountPermissionPlugin',
    ];

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

        if ($this->hasCompanyRoles($companyUserTransfer->getCompanyRoleCollection())) {
            $this->updateCompanyUserRolePermissions($companyUserTransfer);
        }

        return $companyUserTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected function updateCompanyUserRolePermissions(CompanyUserTransfer $companyUserTransfer): CompanyUserTransfer
    {
        $companyRoleTransfer = $companyUserTransfer->getCompanyRoleCollection()
            ->getRoles()
            ->offsetGet(0);

        $companyRoleTransfer->setPermissionCollection(
            $this->getUpdatedPermissionCollectionTransfer($companyRoleTransfer->getPermissionCollection())
        );

        $this->getCompanyRoleFacade()->update($companyRoleTransfer);

        return $companyUserTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PermissionCollectionTransfer $companyRolePermissionCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\PermissionCollectionTransfer
     */
    protected function getUpdatedPermissionCollectionTransfer(
        PermissionCollectionTransfer $companyRolePermissionCollectionTransfer
    ): PermissionCollectionTransfer {
        $availablePermissionCollectionTransfer = $this->getPermissionFacade()
            ->findMergedRegisteredNonInfrastructuralPermissions();

        foreach ($availablePermissionCollectionTransfer->getPermissions() as $permissionTransfer) {
            if (in_array($permissionTransfer->getKey(), static::COMPANY_USER_PERMISSIONS_KEY_LIST, true)) {
                $companyRolePermissionCollectionTransfer = $this->addPermissionToPermissionCollection(
                    $permissionTransfer,
                    $companyRolePermissionCollectionTransfer
                );
            }
        }

        return $companyRolePermissionCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PermissionTransfer $permissionTransfer
     * @param \Generated\Shared\Transfer\PermissionCollectionTransfer $permissionCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\PermissionCollectionTransfer
     */
    protected function addPermissionToPermissionCollection(
        PermissionTransfer $permissionTransfer,
        PermissionCollectionTransfer $permissionCollectionTransfer
    ): PermissionCollectionTransfer {
        foreach ($permissionCollectionTransfer as $companyRolePermissionTransfer) {
            if ($companyRolePermissionTransfer->getIdPermission() === $permissionTransfer->getIdPermission()) {
                return $permissionCollectionTransfer;
            }
        }

        return $permissionCollectionTransfer->addPermission($permissionTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleCollectionTransfer|null $companyRoleCollectionTransfer
     *
     * @return bool
     */
    protected function hasCompanyRoles(?CompanyRoleCollectionTransfer $companyRoleCollectionTransfer): bool
    {
        return $companyRoleCollectionTransfer && $companyRoleCollectionTransfer->getRoles()->count();
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
     * @return \Spryker\Zed\CompanyRole\Business\CompanyRoleFacadeInterface
     */
    protected function getCompanyRoleFacade()
    {
        return $this->getLocator()->companyRole()->facade();
    }

    /**
     * @return \Spryker\Zed\Permission\Business\PermissionFacadeInterface
     */
    protected function getPermissionFacade()
    {
        return $this->getLocator()->permission()->facade();
    }

    /**
     * @return object|\Spryker\Zed\Mail\Business\MailFacadeInterface
     */
    protected function getMailMock()
    {
        return Stub::makeEmpty(MailFacadeInterface::class);
    }
}
