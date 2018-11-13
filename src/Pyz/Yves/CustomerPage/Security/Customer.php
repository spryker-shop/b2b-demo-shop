<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerPage\Security;

use SprykerShop\Yves\CustomerPage\Security\Customer as SprykerCustomer;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

class Customer extends SprykerCustomer implements AdvancedUserInterface
{
    /**
     * @return bool
     */
    public function isAccountNonExpired(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isAccountNonLocked(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isCredentialsNonExpired(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return ($this->customerTransfer->getIdCustomer() && $this->customerTransfer->getIsEnabled()) ? true : false;
    }
}
