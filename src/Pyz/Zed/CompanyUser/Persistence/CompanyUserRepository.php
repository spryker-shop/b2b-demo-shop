<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyUser\Persistence;

use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Spryker\Zed\CompanyUser\Persistence\CompanyUserRepository as SprykerCompanyUserRepository;

/**
 * @method \Spryker\Zed\CompanyUser\Persistence\CompanyUserPersistenceFactory getFactory()
 */
class CompanyUserRepository extends SprykerCompanyUserRepository implements CompanyUserRepositoryInterface
{
    /**
     * @uses \Orm\Zed\Company\Persistence\SpyCompanyQuery
     *
     * @param int $idCustomer
     *
     * @return bool
     */
    public function hasEnabledCompanyUsers(int $idCustomer): bool
    {
        $query = $this->getFactory()
            ->createCompanyUserQuery()
            ->filterByFkCustomer($idCustomer)
            ->filterByIsActive(true)
            ->joinCompany()
            ->useCompanyQuery()
                ->filterByIsActive(true)
                ->filterByStatus(SpyCompanyTableMap::COL_STATUS_APPROVED)
            ->endUse();

        return $query->exists();
    }

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
