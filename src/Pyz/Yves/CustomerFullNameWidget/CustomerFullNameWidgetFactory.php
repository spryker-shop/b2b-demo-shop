<?php



declare(strict_types = 1);

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
