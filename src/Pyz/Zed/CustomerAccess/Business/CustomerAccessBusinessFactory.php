<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccess\Business;

use Pyz\Zed\CustomerAccess\Business\CustomerAccess\CustomerAccessFilter;
use Pyz\Zed\CustomerAccess\Business\CustomerAccess\CustomerAccessFilterInterface;
use Pyz\Zed\CustomerAccess\Business\CustomerAccess\CustomerAccessReader;
use Pyz\Zed\CustomerAccess\Business\CustomerAccess\CustomerAccessReaderInterface;
use Pyz\Zed\CustomerAccess\Business\CustomerAccess\CustomerAccessUpdater;
use Pyz\Zed\CustomerAccess\Business\CustomerAccess\CustomerAccessUpdaterInterface;
use Spryker\Zed\CustomerAccess\Business\CustomerAccessBusinessFactory as SprykerCustomerAccessBusinessFactory;

/**
 * @method \Pyz\Zed\CustomerAccess\CustomerAccessConfig getConfig()
 * @method \Pyz\Zed\CustomerAccess\Persistence\CustomerAccessRepositoryInterface getRepository()
 * @method \Pyz\Zed\CustomerAccess\Persistence\CustomerAccessEntityManagerInterface getEntityManager()
 */
class CustomerAccessBusinessFactory extends SprykerCustomerAccessBusinessFactory
{
    /**
     * @return \Pyz\Zed\CustomerAccess\Business\CustomerAccess\CustomerAccessFilterInterface
     */
    public function createPyzCustomerAccessFilter(): CustomerAccessFilterInterface
    {
        return new CustomerAccessFilter(
            $this->getConfig(),
        );
    }

    /**
     * @return \Pyz\Zed\CustomerAccess\Business\CustomerAccess\CustomerAccessUpdaterInterface
     */
    public function createPyzCustomerAccessUpdater(): CustomerAccessUpdaterInterface
    {
        return new CustomerAccessUpdater(
            $this->getEntityManager(),
            $this->createPyzCustomerAccessReader(),
            $this->createPyzCustomerAccessFilter(),
        );
    }

    /**
     * @return \Pyz\Zed\CustomerAccess\Business\CustomerAccess\CustomerAccessReaderInterface
     */
    public function createPyzCustomerAccessReader(): CustomerAccessReaderInterface
    {
        return new CustomerAccessReader($this->getRepository());
    }
}
