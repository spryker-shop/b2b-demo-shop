<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerFullNameWidget;

use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;

class CustomerFullNameWidgetFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Client\Customer\CustomerClientInterface
     */
    public function getCustomerClient(): CustomerClientInterface
    {
        return $this->getProvidedDependency(CustomerFullNameWidgetDependencyProvider::CLIENT_CUSTOMER);
    }
}
