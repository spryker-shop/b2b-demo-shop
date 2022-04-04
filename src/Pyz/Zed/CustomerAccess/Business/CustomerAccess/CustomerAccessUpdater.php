<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccess\Business\CustomerAccess;

use Generated\Shared\Transfer\CustomerAccessTransfer;
use Pyz\Zed\CustomerAccess\Persistence\CustomerAccessEntityManagerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class CustomerAccessUpdater implements CustomerAccessUpdaterInterface
{
    use TransactionTrait;

    /**
     * @var \Pyz\Zed\CustomerAccess\Persistence\CustomerAccessEntityManagerInterface
     */
    protected $customerAccessEntityManager;

    /**
     * @var \Pyz\Zed\CustomerAccess\Business\CustomerAccess\CustomerAccessReaderInterface
     */
    protected $customerAccessReader;

    /**
     * @var \Pyz\Zed\CustomerAccess\Business\CustomerAccess\CustomerAccessFilterInterface
     */
    protected $customerAccessFilter;

    /**
     * @param \Pyz\Zed\CustomerAccess\Persistence\CustomerAccessEntityManagerInterface $customerAccessEntityManager
     * @param \Pyz\Zed\CustomerAccess\Business\CustomerAccess\CustomerAccessReaderInterface $customerAccessReader
     * @param \Pyz\Zed\CustomerAccess\Business\CustomerAccess\CustomerAccessFilterInterface $customerAccessFilter
     */
    public function __construct(
        CustomerAccessEntityManagerInterface $customerAccessEntityManager,
        CustomerAccessReaderInterface $customerAccessReader,
        CustomerAccessFilterInterface $customerAccessFilter
    ) {
        $this->customerAccessEntityManager = $customerAccessEntityManager;
        $this->customerAccessReader = $customerAccessReader;
        $this->customerAccessFilter = $customerAccessFilter;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAccessTransfer
     */
    public function updateUnauthenticatedCustomerAccess(CustomerAccessTransfer $customerAccessTransfer): CustomerAccessTransfer
    {
        return $this->getTransactionHandler()->handleTransaction(function () use ($customerAccessTransfer) {
            $allContentTypes = $this->customerAccessReader->getAllContentTypes();
            $manageableContentTypes = $this->customerAccessFilter->filterManageableContentTypes($allContentTypes);
            $this->customerAccessEntityManager->setPyzContentTypesToAccessible($manageableContentTypes);

            return $this->customerAccessEntityManager->setPyzContentTypesToInaccessible($customerAccessTransfer);
        });
    }
}
