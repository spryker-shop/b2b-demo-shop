<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CompanyPage\Plugin\ShopApplication;

use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use SprykerShop\Yves\CompanyPage\Controller\AbstractCompanyController;
use SprykerShop\Yves\CompanyPage\Plugin\ShopApplication\CompanyUserRestrictionHandlerPlugin as SprykerCompanyUserRestrictionHandlerPlugin;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyUserRestrictionHandlerPlugin extends SprykerCompanyUserRestrictionHandlerPlugin
{
    protected const COMPANY_ROLE_ADMIN = 'Spryker_Admin';

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Symfony\Component\HttpKernel\Event\FilterControllerEvent $event
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
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

        throw new NotFoundHttpException(static::GLOSSARY_KEY_COMPANY_PAGE_RESTRICTED);
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

        if ($customerTransfer->getIsOnBehalf()) {
            return true;
        }

        if ($companyUserTransfer && $this->hasRole($companyUserTransfer, static::COMPANY_ROLE_ADMIN)) {
            return true;
        }

        return false;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $customerTransfer
     * @param string $roleKey
     *
     * @return bool
     */
    public function hasRole(CompanyUserTransfer $customerTransfer, string $roleKey): bool
    {
        $roles = $customerTransfer
            ->getCompanyRoleCollection()
            ->getRoles();

        foreach ($roles as $role) {
            if ($role->getKey() === $roleKey) {
                return true;
            }
        }

        return false;
    }
}
