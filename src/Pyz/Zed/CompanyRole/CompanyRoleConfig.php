<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyRole;

use Generated\Shared\Transfer\CompanyRoleTransfer;
use Pyz\Zed\CompanyUser\Communication\Plugin\Permission\SeeCompanyMenuPermissionPlugin;
use Spryker\Client\CompanyUser\Plugin\CompanyUserStatusChangePermissionPlugin;
use Spryker\Client\QuoteApproval\Plugin\Permission\RequestQuoteApprovalPermissionPlugin;
use Spryker\Shared\Checkout\Plugin\Permission\PlaceOrderWithAmountUpToPermissionPlugin;
use Spryker\Shared\CompanyUser\Plugin\AddCompanyUserPermissionPlugin;
use Spryker\Shared\CompanyUserInvitation\Plugin\ManageCompanyUserInvitationPermissionPlugin;
use Spryker\Zed\CompanyRole\CompanyRoleConfig as SprykerCompanyRoleConfig;
use Spryker\Zed\QuoteApproval\Communication\Plugin\Permission\ApproveQuotePermissionPlugin;
use Spryker\Zed\QuoteApproval\Communication\Plugin\Permission\PlaceOrderPermissionPlugin;
use SprykerShop\Shared\CartPage\Plugin\AddCartItemPermissionPlugin;
use SprykerShop\Shared\CartPage\Plugin\ChangeCartItemPermissionPlugin;
use SprykerShop\Shared\CartPage\Plugin\RemoveCartItemPermissionPlugin;

class CompanyRoleConfig extends SprykerCompanyRoleConfig
{
    /**
     * @var string
     */
    protected const BUYER_ROLE_NAME = 'Buyer';

    /**
     * @var string
     */
    protected const APPROVER_ROLE_NAME = 'Approver';

    /**
     * @var string
     */
    protected const BUYER_WITH_LIMIT_ROLE_NAME = 'Buyer With Limit';

    /**
     * @return array<string>
     */
    public function getAdminRolePermissionKeys(): array
    {
        return [
            AddCompanyUserPermissionPlugin::KEY,
            ManageCompanyUserInvitationPermissionPlugin::KEY,
            CompanyUserStatusChangePermissionPlugin::KEY,
            SeeCompanyMenuPermissionPlugin::KEY,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getBuyerRolePermissionKeys(): array
    {
        return [
            AddCartItemPermissionPlugin::KEY,
            ChangeCartItemPermissionPlugin::KEY,
            RemoveCartItemPermissionPlugin::KEY,
            PlaceOrderWithAmountUpToPermissionPlugin::KEY,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getApproverRolePermissionKeys(): array
    {
        return [
            ApproveQuotePermissionPlugin::KEY,
        ];
    }

    /**
     * @return array<\Generated\Shared\Transfer\CompanyRoleTransfer>
     */
    public function getPredefinedCompanyRoles(): array
    {
        $companyRoleTransfers = parent::getPredefinedCompanyRoles();
        $companyRoleTransfers[] = $this->getBuyerRole();
        $companyRoleTransfers[] = $this->getApproverRole();
        $companyRoleTransfers[] = $this->getBuyerWithLimitRole();

        return $companyRoleTransfers;
    }

    /**
     * @return \Generated\Shared\Transfer\CompanyRoleTransfer
     */
    protected function getBuyerRole(): CompanyRoleTransfer
    {
        return (new CompanyRoleTransfer())
            ->setName(static::BUYER_ROLE_NAME)
            ->setPermissionCollection($this->createPermissionCollectionFromPermissionKeys(
                $this->getBuyerRolePermissionKeys(),
            ));
    }

    /**
     * @return \Generated\Shared\Transfer\CompanyRoleTransfer
     */
    protected function getApproverRole(): CompanyRoleTransfer
    {
        return (new CompanyRoleTransfer())
            ->setName(static::APPROVER_ROLE_NAME)
            ->setPermissionCollection($this->createPermissionCollectionFromPermissionKeys(
                $this->getApproverRolePermissionKeys(),
            ));
    }

    /**
     * @return \Generated\Shared\Transfer\CompanyRoleTransfer
     */
    protected function getBuyerWithLimitRole(): CompanyRoleTransfer
    {
        return (new CompanyRoleTransfer())
            ->setName(static::BUYER_WITH_LIMIT_ROLE_NAME)
            ->setPermissionCollection($this->createPermissionCollectionFromPermissionKeys(
                $this->getBuyerWithLimitRolePermissionKeys(),
            ));
    }

    /**
     * @return array<string>
     */
    protected function getBuyerWithLimitRolePermissionKeys(): array
    {
        return [
            AddCartItemPermissionPlugin::KEY,
            ChangeCartItemPermissionPlugin::KEY,
            RemoveCartItemPermissionPlugin::KEY,
            PlaceOrderWithAmountUpToPermissionPlugin::KEY,
            RequestQuoteApprovalPermissionPlugin::KEY,
            PlaceOrderPermissionPlugin::KEY,
        ];
    }
}
