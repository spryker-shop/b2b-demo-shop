<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CompanyPage\Plugin\ShopApplication;

use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use SprykerShop\Yves\CompanyPage\Controller\AbstractCompanyController;
use SprykerShop\Yves\CompanyPage\Exception\CustomerAccessDeniedException;
use SprykerShop\Yves\CompanyPage\Plugin\ShopApplication\CompanyUserRestrictionHandlerPlugin as SprykerCompanyUserRestrictionHandlerPlugin;
use Symfony\Component\HttpKernel\Event\ControllerEvent;

class CompanyUserRestrictionHandlerPlugin extends SprykerCompanyUserRestrictionHandlerPlugin
{
    /**
     * @var string
     */
    protected const PERMISSION_KEY = 'SeeCompanyMenuPermissionPlugin';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Symfony\Component\HttpKernel\Event\ControllerEvent $event
     *
     * @throws \SprykerShop\Yves\CompanyPage\Exception\CustomerAccessDeniedException
     *
     * @return void
     */
    public function handle(ControllerEvent $event): void
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
        $companyUserTransfer = $customerTransfer->getCompanyUserTransfer();

        return $companyUserTransfer && $this->hasPermission($companyUserTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $customerTransfer
     *
     * @return bool
     */
    protected function hasPermission(CompanyUserTransfer $customerTransfer): bool
    {
        $companyRoleTransfers = $customerTransfer
            ->getCompanyRoleCollection()
            ->getRoles();

        foreach ($companyRoleTransfers as $companyRoleTransfer) {
            foreach ($companyRoleTransfer->getPermissionCollection()->getPermissions() as $permissionTransfer) {
                if ($permissionTransfer->getKey() === static::PERMISSION_KEY) {
                    return true;
                }
            }
        }

        return false;
    }
}
