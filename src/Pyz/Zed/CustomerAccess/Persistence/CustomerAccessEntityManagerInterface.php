<?php



declare(strict_types = 1);

namespace Pyz\Zed\CustomerAccess\Persistence;

use Generated\Shared\Transfer\CustomerAccessTransfer;
use Spryker\Zed\CustomerAccess\Persistence\CustomerAccessEntityManagerInterface as SprykerCustomerAccessEntityManagerInterface;

interface CustomerAccessEntityManagerInterface extends SprykerCustomerAccessEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     *
     * @return void
     */
    public function setContentTypesToAccessible(CustomerAccessTransfer $customerAccessTransfer): void;
}
