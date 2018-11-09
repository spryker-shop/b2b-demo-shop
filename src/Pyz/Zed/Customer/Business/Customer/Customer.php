<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Customer\Business\Customer;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Customer\Business\Customer\Customer as SprykerCustomer;

class Customer extends SprykerCustomer
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function get(CustomerTransfer $customerTransfer): CustomerTransfer
    {
        $customerEntity = $this->getCustomer($customerTransfer);
        $customerTransfer->fromArray($customerEntity->toArray(), true);

        $customerTransfer = $this->attachAddresses($customerTransfer, $customerEntity);
        $customerTransfer = $this->attachLocale($customerTransfer, $customerEntity);
        $customerTransfer->setIsEnabled(true);
        $customerTransfer = $this->customerExpander->expand($customerTransfer);

        return $customerTransfer;
    }
}
