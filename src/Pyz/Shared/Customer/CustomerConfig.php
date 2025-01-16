<?php



declare(strict_types = 1);

namespace Pyz\Shared\Customer;

use Spryker\Shared\Customer\CustomerConfig as SprykerCustomerConfig;

class CustomerConfig extends SprykerCustomerConfig
{
    /**
     * @api
     *
     * @return bool
     */
    public function isDoubleOptInEnabled(): bool
    {
        return true;
    }
}
