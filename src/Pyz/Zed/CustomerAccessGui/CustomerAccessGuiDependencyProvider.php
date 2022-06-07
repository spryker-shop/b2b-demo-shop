<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccessGui;

use Spryker\Zed\CustomerAccessGui\CustomerAccessGuiDependencyProvider as SprykerCustomerAccessGuiDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CustomerAccessGuiDependencyProvider extends SprykerCustomerAccessGuiDependencyProvider
{
    /**
     * @var string
     */
    public const PYZ_FACADE_CUSTOMER_ACCESS = 'PYZ_FACADE_CUSTOMER_ACCESS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addPyzCustomerAccessFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPyzCustomerAccessFacade(Container $container): Container
    {
        $container->set(static::PYZ_FACADE_CUSTOMER_ACCESS, function (Container $container) {
            return $container->getLocator()->customerAccess()->facade();
        });

        return $container;
    }
}
