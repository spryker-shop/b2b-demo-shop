<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccess\Persistence;

use Orm\Zed\CustomerAccess\Persistence\SpyUnauthenticatedCustomerAccessQuery;
use Pyz\Zed\CustomerAccess\Persistence\Propel\Mapper\CustomerAccessMapper;
use Spryker\Zed\CustomerAccess\Persistence\CustomerAccessPersistenceFactory as SprykerCustomerAccessPersistenceFactory;

/**
 * @method \Pyz\Zed\CustomerAccess\Persistence\CustomerAccessEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\CustomerAccess\CustomerAccessConfig getConfig()
 * @method \Pyz\Zed\CustomerAccess\Persistence\CustomerAccessRepositoryInterface getRepository()
 */
class CustomerAccessPersistenceFactory extends SprykerCustomerAccessPersistenceFactory
{
    /**
     * @return \Orm\Zed\CustomerAccess\Persistence\SpyUnauthenticatedCustomerAccessQuery
     */
    public function getPyzUnauthenticatedCustomerAccessQuery(): SpyUnauthenticatedCustomerAccessQuery
    {
        return SpyUnauthenticatedCustomerAccessQuery::create();
    }

    /**
     * @return \Pyz\Zed\CustomerAccess\Persistence\Propel\Mapper\CustomerAccessMapper
     */
    public function createPyzCustomerAccessMapper(): CustomerAccessMapper
    {
        return new CustomerAccessMapper();
    }
}
