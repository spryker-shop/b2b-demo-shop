<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductUrlCartConnector;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductUrlCartConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PYZ_FACADE_PRODUCT = 'PYZ_FACADE_PRODUCT';

    /**
     * @var string
     */
    public const PYZ_FACADE_LOCALE = 'PYZ_FACADE_LOCALE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addPyzFacadeProduct($container);
        $container = $this->addPyzFacadeLocale($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPyzFacadeProduct(Container $container): Container
    {
        $container->set(static::PYZ_FACADE_PRODUCT, function (Container $container) {
            return $container->getLocator()->product()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPyzFacadeLocale(Container $container): Container
    {
        $container->set(static::PYZ_FACADE_PRODUCT, function (Container $container) {
            return $container->getLocator()->locale()->facade();
        });

        return $container;
    }
}
