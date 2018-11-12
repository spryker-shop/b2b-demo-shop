<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyUser\Persistence;

use Spryker\Zed\CompanyUser\Persistence\CompanyUserRepositoryInterface as SprykerCompanyUserRepositoryInterface;

interface CompanyUserRepositoryInterface extends SprykerCompanyUserRepositoryInterface
{
    /**
     * @uses \Orm\Zed\Company\Persistence\SpyCompanyQuery
     *
     * @param int $idCustomer
     *
     * @return int
     */
    public function countCompanyUsersByIdCustomer(int $idCustomer): int;

    /**
     * @uses \Orm\Zed\Company\Persistence\SpyCompanyQuery
     *
     * @param int $idCustomer
     *
     * @return bool
     */
    public function hasEnabledCompanyUsers(int $idCustomer): bool;
}
