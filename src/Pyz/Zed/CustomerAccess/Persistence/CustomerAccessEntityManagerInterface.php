<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

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
