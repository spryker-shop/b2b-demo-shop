<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ExampleProductSalePage;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ExampleProductSalePageDependencyProvider extends AbstractBundleDependencyProvider
{
    public const QUERY_CONTAINER_PRODUCT_LABEL = 'QUERY_CONTAINER_PRODUCT_LABEL';
    public const QUERY_CONTAINER_PRODUCT = 'QUERY_CONTAINER_PRODUCT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container)
    {
        $container = $this->addProductLabelQueryContainer($container);
        $container = $this->addProductQueryContainer($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductLabelQueryContainer(Container $container)
    {
        $container->set(static::QUERY_CONTAINER_PRODUCT_LABEL, function (Container $container) {
            return $container->getLocator()->productLabel()->queryContainer();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductQueryContainer(Container $container)
    {
        $container->set(static::QUERY_CONTAINER_PRODUCT, function (Container $container) {
            return $container->getLocator()->product()->queryContainer();
        });

        return $container;
    }
}
