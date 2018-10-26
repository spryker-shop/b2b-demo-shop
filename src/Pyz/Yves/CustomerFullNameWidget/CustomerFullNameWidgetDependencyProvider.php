<?php
/**
 * Created by PhpStorm.
 * User: kravchenko
 * Date: 10/26/18
 * Time: 4:55 PM
 */

namespace Pyz\Yves\CustomerFullNameWidget;


use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class CustomerFullNameWidgetDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_CUSTOMER = 'CLIENT_CUSTOMER';

    public function provideDependencies(Container $container)
    {
        $container = $this->addCustomerClient($container);

        return $container;
    }

    protected function addCustomerClient(Container $container): Container
    {
        $container[static::CLIENT_CUSTOMER] = function (Container $container) {
            return $container->getLocator()->customer()->client();
        };

        return $container;
    }
}
