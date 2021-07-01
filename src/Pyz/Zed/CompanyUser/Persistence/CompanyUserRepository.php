<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyUser\Persistence;

use Spryker\Zed\CompanyUser\Persistence\CompanyUserRepository as SprykerCompanyUserRepository;

/**
 * @method \Spryker\Zed\CompanyUser\Persistence\CompanyUserPersistenceFactory getFactory()
 */
class CompanyUserRepository extends SprykerCompanyUserRepository implements CompanyUserRepositoryInterface
{
    /**
     * @param int $idCustomer
     *
     * @return int
     */
    public function countCompanyUsersByIdCustomer(int $idCustomer): int
    {
        return $this->getFactory()
            ->createCompanyUserQuery()
            ->filterByFkCustomer($idCustomer)
            ->count();
    }
}
