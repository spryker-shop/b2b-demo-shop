<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CompanyPage\Plugin\ShopApplication;

use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use SprykerShop\Yves\CompanyPage\Controller\AbstractCompanyController;
use SprykerShop\Yves\CompanyPage\Exception\CustomerAccessDeniedException;
use SprykerShop\Yves\CompanyPage\Plugin\ShopApplication\CompanyUserRestrictionHandlerPlugin as SprykerCompanyUserRestrictionHandlerPlugin;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class CompanyUserRestrictionHandlerPlugin extends SprykerCompanyUserRestrictionHandlerPlugin
{
    protected const PERMISSION_KEY = 'SeeCompanyMenuPermissionPlugin';

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Symfony\Component\HttpKernel\Event\FilterControllerEvent $event
     *
     * @throws \SprykerShop\Yves\CompanyPage\Exception\CustomerAccessDeniedException
     *
     * @return void
     */
    public function handle(FilterControllerEvent $event): void
    {
        $eventController = $event->getController();

        if (!is_array($eventController)) {
            return;
        }

        [$controllerInstance, $actionName] = $eventController;

        if (!($controllerInstance instanceof AbstractCompanyController)) {
            return;
        }

        $customerTransfer = $this->getFactory()->getCustomerClient()->getCustomer();

        if ($this->canAccess($customerTransfer)) {
            return;
        }

        throw new CustomerAccessDeniedException(static::GLOSSARY_KEY_COMPANY_PAGE_RESTRICTED);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return bool
     */
    protected function canAccess(CustomerTransfer $customerTransfer): bool
    {
        if (!$customerTransfer) {
            return false;
        }

        $companyUserTransfer = $customerTransfer->getCompanyUserTransfer();

        if ($companyUserTransfer && $this->hasPermission($companyUserTransfer, static::PERMISSION_KEY)) {
            return true;
        }

        return false;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $customerTransfer
     * @param string $permissionKey
     *
     * @return bool
     */
    protected function hasPermission(CompanyUserTransfer $customerTransfer, string $permissionKey): bool
    {
        $roles = $customerTransfer
            ->getCompanyRoleCollection()
            ->getRoles();

        foreach ($roles as $role) {
            foreach ($role->getPermissionCollection()->getPermissions() as $permission) {
                if ($permission->getKey() === static::PERMISSION_KEY) {
                    return true;
                }
            }
        }

        return false;
    }
}
