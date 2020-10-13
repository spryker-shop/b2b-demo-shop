<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerPage\Security;

use SprykerShop\Yves\CustomerPage\Security\Customer as SprykerCustomer;

class Customer extends SprykerCustomer
{
    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return ($this->customerTransfer->getIdCustomer() && $this->customerTransfer->getIsEnabled()) ? true : false;
    }
}
