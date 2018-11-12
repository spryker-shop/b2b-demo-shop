<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyUser\Business;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\CompanyUser\Business\CompanyUserFacade as SprykerCompanyUserFacade;

/**
 * @method \Pyz\Zed\CompanyUser\Business\CompanyUserBusinessFactory getFactory()
 */
class CompanyUserFacade extends SprykerCompanyUserFacade implements CompanyUserFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return bool
     */
    public function hasActiveCompanyUsers(CustomerTransfer $customerTransfer): bool
    {
        return $this->getFactory()
            ->createCompanyUser()
            ->hasActiveCompanyUsers($customerTransfer);
    }
}
