<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyUser\Persistence;

use Generated\Shared\Transfer\CompanyUserTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Spryker\Zed\CompanyUser\Persistence\CompanyUserRepository as SprykerCompanyUserRepository;

/**
 * @method \Spryker\Zed\CompanyUser\Persistence\CompanyUserPersistenceFactory getFactory()
 */
class CompanyUserRepository extends SprykerCompanyUserRepository
{
    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer|null
     */
    public function findActiveCompanyUserByCustomerId(int $idCustomer): ?CompanyUserTransfer
    {
        $query = $this->getFactory()
            ->createCompanyUserQuery()
            ->filterByIsActive(true)
            ->filterByFkCustomer($idCustomer)
            ->joinCompany()
            ->useCompanyQuery()
            ->filterByIsActive(true)
            ->endUse();

        $entityTransfer = $this->buildQueryFromCriteria($query)->findOne();

        if ($entityTransfer !== null) {
            return $this->getFactory()
                ->createCompanyUserMapper()
                ->mapEntityTransferToCompanyUserTransfer($entityTransfer);
        }

        return null;
    }

    /**
     * @uses \Orm\Zed\Company\Persistence\SpyCompanyQuery
     *
     * @param int $idCustomer
     *
     * @return int
     */
    public function countActiveCompanyUsersByIdCustomer(int $idCustomer): int
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

        return $query->count();
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
