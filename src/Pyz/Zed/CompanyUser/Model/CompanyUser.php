<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyUser\Model;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\CompanyUser\Business\Model\CompanyUser as SprykerCompanyUser;

class CompanyUser extends SprykerCompanyUser
{
    /**
     * @var \Pyz\Zed\CompanyUser\Persistence\CompanyUserRepositoryInterface
     */
    protected $companyUserRepository;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return bool
     */
    public function hasActiveCompanyUsers(CustomerTransfer $customerTransfer): bool
    {
        if ($this->companyUserRepository->countCompanyUsersByIdCustomer($customerTransfer->getIdCustomer()) === 0) {
            return true;
        }

        return $this->companyUserRepository->hasEnabledCompanyUsers($customerTransfer->getIdCustomer());
    }
}
