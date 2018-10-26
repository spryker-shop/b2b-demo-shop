<?php
/**
 * Created by PhpStorm.
 * User: kravchenko
 * Date: 10/26/18
 * Time: 5:00 PM
 */

namespace Pyz\Yves\CustomerFullNameWidget;


use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;

class CustomerFullNameWidgetFactory extends AbstractFactory
{
    /**
     * @return CustomerClientInterface
     */
    public function getCustomerClient(): CustomerClientInterface
    {
        return $this->getProvidedDependency(CustomerFullNameWidgetDependencyProvider::CLIENT_CUSTOMER);
    }
}
