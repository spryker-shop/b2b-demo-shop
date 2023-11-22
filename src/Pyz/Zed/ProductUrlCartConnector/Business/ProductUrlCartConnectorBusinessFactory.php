<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductUrlCartConnector\Business;

use Pyz\Zed\ProductUrlCartConnector\Business\Expander\ProductUrlExpander;
use Pyz\Zed\ProductUrlCartConnector\Business\Expander\ProductUrlExpanderInterface;
use Pyz\Zed\ProductUrlCartConnector\ProductUrlCartConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;
use Spryker\Zed\Product\Business\ProductFacadeInterface;

/**
 * @method \Pyz\Zed\ProductUrlCartConnector\ProductUrlCartConnectorConfig getConfig()
 */
class ProductUrlCartConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\ProductUrlCartConnector\Business\Expander\ProductUrlExpanderInterface
     */
    public function createProductExpander(): ProductUrlExpanderInterface
    {
        return new ProductUrlExpander(
            $this->getProductFacade(),
            $this->getLocaleFacade(),
        );
    }

    /**
     * @return \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected function getProductFacade(): ProductFacadeInterface
    {
        return $this->getProvidedDependency(ProductUrlCartConnectorDependencyProvider::FACADE_PRODUCT);
    }

    /**
     * @return \Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected function getLocaleFacade(): LocaleFacadeInterface
    {
        return $this->getProvidedDependency(ProductUrlCartConnectorDependencyProvider::FACADE_LOCALE);
    }
}
