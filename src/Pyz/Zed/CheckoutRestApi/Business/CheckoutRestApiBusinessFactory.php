<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CheckoutRestApi\Business;

use Pyz\Zed\CheckoutRestApi\Business\Checkout\CheckoutDataWriter;
use Pyz\Zed\CheckoutRestApi\Business\Checkout\CheckoutDataWriterInterface;
use Pyz\Zed\CheckoutRestApi\CheckoutRestApiDependencyProvider;
use Spryker\Zed\CheckoutRestApi\Business\CheckoutRestApiBusinessFactory as SprykerCheckoutRestApiBusinessFactory;
use Spryker\Zed\Quote\Business\QuoteFacadeInterface;

/**
 * @method \Spryker\Zed\CheckoutRestApi\CheckoutRestApiConfig getConfig()
 */
class CheckoutRestApiBusinessFactory extends SprykerCheckoutRestApiBusinessFactory
{
    /**
     * @return \Pyz\Zed\CheckoutRestApi\Business\Checkout\CheckoutDataWriterInterface
     */
    public function createCheckoutDataWriter(): CheckoutDataWriterInterface
    {
        return new CheckoutDataWriter(
            $this->createQuoteReader(),
            $this->getQuoteMapperPlugins(),
            $this->getCalculationFacade(),
            $this->getBaseQuoteFacade()
        );
    }

    /**
     * @return \Spryker\Zed\Quote\Business\QuoteFacadeInterface
     */
    public function getBaseQuoteFacade(): QuoteFacadeInterface
    {
        return $this->getProvidedDependency(CheckoutRestApiDependencyProvider::FACADE_QUOTE_BASE);
    }
}
