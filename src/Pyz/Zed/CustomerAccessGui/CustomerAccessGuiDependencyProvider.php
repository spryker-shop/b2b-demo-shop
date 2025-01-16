<?php



declare(strict_types = 1);

namespace Pyz\Zed\CustomerAccessGui;

use Spryker\Zed\CustomerAccessGui\CustomerAccessGuiDependencyProvider as SprykerCustomerAccessGuiDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CustomerAccessGuiDependencyProvider extends SprykerCustomerAccessGuiDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerAccessFacade(Container $container): Container
    {
        $container->set(static::FACADE_CUSTOMER_ACCESS, function (Container $container) {
            return $container->getLocator()->customerAccess()->facade();
        });

        return $container;
    }
}
