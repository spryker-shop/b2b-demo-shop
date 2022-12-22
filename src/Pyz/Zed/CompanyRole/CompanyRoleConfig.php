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
    protected const PYZ_BUYER_ROLE_NAME = 'Buyer';

    /**
     * @var string
     */
    protected const PYZ_APPROVER_ROLE_NAME = 'Approver';

    /**
     * @var string
     */
    protected const PYZ_BUYER_WITH_LIMIT_ROLE_NAME = 'Buyer With Limit';

    /**
     * @return array<string>
     */
    public function getAdminRolePermissionKeys(): array
    {
        return [
            AddCompanyUserPermissionPlugin::KEY,
            ManageCompanyUserInvitationPermissionPlugin::KEY,
            CompanyUserStatusChangePermissionPlugin::KEY,
            SeeCompanyMenuPermissionPlugin::PYZ_KEY,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getPyzBuyerRolePermissionKeys(): array
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
    protected function getPyzApproverRolePermissionKeys(): array
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
        $companyRoleTransfers[] = $this->getPyzBuyerRole();
        $companyRoleTransfers[] = $this->getPyzApproverRole();
        $companyRoleTransfers[] = $this->getPyzBuyerWithLimitRole();

        return $companyRoleTransfers;
    }

    /**
     * @return \Generated\Shared\Transfer\CompanyRoleTransfer
     */
    protected function getPyzBuyerRole(): CompanyRoleTransfer
    {
        return (new CompanyRoleTransfer())
            ->setName(static::PYZ_BUYER_ROLE_NAME)
            ->setPermissionCollection($this->createPermissionCollectionFromPermissionKeys(
                $this->getPyzBuyerRolePermissionKeys(),
            ));
    }

    /**
     * @return \Generated\Shared\Transfer\CompanyRoleTransfer
     */
    protected function getPyzApproverRole(): CompanyRoleTransfer
    {
        return (new CompanyRoleTransfer())
            ->setName(static::PYZ_APPROVER_ROLE_NAME)
            ->setPermissionCollection($this->createPermissionCollectionFromPermissionKeys(
                $this->getPyzApproverRolePermissionKeys(),
            ));
    }

    /**
     * @return \Generated\Shared\Transfer\CompanyRoleTransfer
     */
    protected function getPyzBuyerWithLimitRole(): CompanyRoleTransfer
    {
        return (new CompanyRoleTransfer())
            ->setName(static::PYZ_BUYER_WITH_LIMIT_ROLE_NAME)
            ->setPermissionCollection($this->createPermissionCollectionFromPermissionKeys(
                $this->getPyzBuyerWithLimitRolePermissionKeys(),
            ));
    }

    /**
     * @return array<string>
     */
    protected function getPyzBuyerWithLimitRolePermissionKeys(): array
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
