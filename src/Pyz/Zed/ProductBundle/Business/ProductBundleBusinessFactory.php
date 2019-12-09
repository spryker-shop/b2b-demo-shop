<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductBundle\Business;

use Pyz\Zed\ProductBundle\ProductBundleDependencyProvider;
use Spryker\Zed\ProductBundle\Business\ProductBundleBusinessFactory as SprykerProductBundleBusinessFactory;

/**
 * @method \Spryker\Zed\ProductBundle\ProductBundleConfig getConfig()
 * @method \Spryker\Zed\ProductBundle\Persistence\ProductBundleQueryContainerInterface getQueryContainer()
 */
class ProductBundleBusinessFactory extends SprykerProductBundleBusinessFactory
{
    /**
     * @return \Spryker\Zed\ProductBundle\Business\ProductBundle\ProductBundleWriterInterface
     */
    public function createProductBundleWriter()
    {
        return new ProductBundleWriter(
            $this->getQueryContainer(),
            $this->createProductBundleStockWriter(),
            $this->getEventFacade()
        );
    }

    /**
     * @return \Spryker\Zed\Event\Business\EventFacadeInterface
     */
    protected function getEventFacade()
    {
        return $this->getProvidedDependency(ProductBundleDependencyProvider::FACADE_EVENT);
    }
}
