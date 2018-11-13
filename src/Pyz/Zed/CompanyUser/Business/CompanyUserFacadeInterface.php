<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyUser\Business;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\CompanyUser\Business\CompanyUserFacadeInterface as SprykerCompanyUserFacadeInterface;

interface CompanyUserFacadeInterface extends SprykerCompanyUserFacadeInterface
{
    /**
     * Specification:
     * - Retrieves company users for customer.
     * - Returns true if no company users registered
     * - Returns false if all company users are disabled ('is_active' flag is set to false).
     * - Returns true otherwise.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return bool
     */
    public function hasActiveCompanyUsers(CustomerTransfer $customerTransfer): bool;
}
