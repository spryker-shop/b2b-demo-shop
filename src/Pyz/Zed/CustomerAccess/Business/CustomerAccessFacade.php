<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccess\Business;

use Generated\Shared\Transfer\CustomerAccessTransfer;
use Spryker\Zed\CustomerAccess\Business\CustomerAccessFacade as SprykerCustomerAccessFacade;
use Spryker\Zed\CustomerAccessGui\Dependency\Facade\CustomerAccessGuiToCustomerAccessFacadeInterface;

/**
 * @method \Pyz\Zed\CustomerAccess\Business\CustomerAccessBusinessFactory getFactory()
 * @method \Pyz\Zed\CustomerAccess\Persistence\CustomerAccessEntityManagerInterface getEntityManager()
 * @method \Spryker\Zed\CustomerAccess\Persistence\CustomerAccessRepositoryInterface getRepository()
 */
class CustomerAccessFacade extends SprykerCustomerAccessFacade implements CustomerAccessFacadeInterface, CustomerAccessGuiToCustomerAccessFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function filterManageableContentTypes(CustomerAccessTransfer $customerAccessTransfer): CustomerAccessTransfer
    {
        return $this->getFactory()
            ->createCustomerAccessFilter()
            ->filterManageableContentTypes($customerAccessTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function filterNonManageableContentTypes(CustomerAccessTransfer $customerAccessTransfer): CustomerAccessTransfer
    {
        return $this->getFactory()
            ->createCustomerAccessFilter()
            ->filterNonManageableContentTypes($customerAccessTransfer);
    }
}
