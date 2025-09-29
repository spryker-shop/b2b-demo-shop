<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\CustomerAccess\Business\CustomerAccess;

use Generated\Shared\Transfer\CustomerAccessTransfer;
use Pyz\Zed\CustomerAccess\Persistence\CustomerAccessEntityManagerInterface;
use Spryker\Zed\CustomerAccess\Business\CustomerAccess\CustomerAccessReaderInterface;
use Spryker\Zed\CustomerAccess\Business\CustomerAccess\CustomerAccessUpdater as SprykerCustomerAccessUpdater;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class CustomerAccessUpdater extends SprykerCustomerAccessUpdater
{
    use TransactionTrait;

    protected $customerAccessEntityManager;

    protected CustomerAccessReaderInterface $customerAccessReader;

    protected CustomerAccessFilterInterface $customerAccessFilter;

    public function __construct(
        CustomerAccessEntityManagerInterface $customerAccessEntityManager,
        CustomerAccessReaderInterface $customerAccessReader,
        CustomerAccessFilterInterface $customerAccessFilter,
    ) {
        parent::__construct($customerAccessEntityManager);
        $this->customerAccessReader = $customerAccessReader;
        $this->customerAccessFilter = $customerAccessFilter;
    }

    public function updateUnauthenticatedCustomerAccess(CustomerAccessTransfer $customerAccessTransfer): CustomerAccessTransfer
    {
        return $this->getTransactionHandler()->handleTransaction(function () use ($customerAccessTransfer) {
            $allContentTypes = $this->customerAccessReader->getAllContentTypes();
            $manageableContentTypes = $this->customerAccessFilter->filterManageableContentTypes($allContentTypes);
            $this->customerAccessEntityManager->setContentTypesToAccessible($manageableContentTypes);

            return $this->customerAccessEntityManager->setContentTypesToInaccessible($customerAccessTransfer);
        });
    }
}
