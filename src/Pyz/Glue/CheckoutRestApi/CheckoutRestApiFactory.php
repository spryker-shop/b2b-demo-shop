<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\CheckoutRestApi;

use Pyz\Glue\CheckoutRestApi\Processor\CheckoutUpdate\CheckoutDataUpdater;
use Pyz\Glue\CheckoutRestApi\Processor\CheckoutUpdate\CheckoutDataUpdaterInterface;
use Pyz\Glue\CheckoutRestApi\Processor\CheckoutUpdate\CheckoutUpdateMapper;
use Pyz\Glue\CheckoutRestApi\Processor\CheckoutUpdate\CheckoutUpdateMapperInterface;
use Pyz\Glue\CheckoutRestApi\Processor\Customer\CustomerMapper;
use Spryker\Glue\CheckoutRestApi\CheckoutRestApiFactory as SprykerCheckoutRestApiFactory;
use Spryker\Glue\CheckoutRestApi\Processor\Customer\CustomerMapperInterface;

/**
 * @method \Pyz\Client\CheckoutRestApi\CheckoutRestApiClientInterface getClient()
 * @method \Pyz\Glue\CheckoutRestApi\CheckoutRestApiConfig getConfig()
 */
class CheckoutRestApiFactory extends SprykerCheckoutRestApiFactory
{
    /**
     * @return \Pyz\Glue\CheckoutRestApi\Processor\CheckoutUpdate\CheckoutDataUpdaterInterface
     */
    public function createCheckoutDataUpdater(): CheckoutDataUpdaterInterface
    {
        return new CheckoutDataUpdater(
            $this->getClient(),
            $this->getResourceBuilder(),
            $this->createCheckoutUpdateMapper(),
            $this->createCheckoutRequestAttributesExpander(),
            $this->createCheckoutRequestValidator(),
            $this->createRestCheckoutErrorMapper()
        );
    }

    /**
     * @return \Pyz\Glue\CheckoutRestApi\Processor\CheckoutUpdate\CheckoutUpdateMapperInterface
     */
    public function createCheckoutUpdateMapper(): CheckoutUpdateMapperInterface
    {
        return new CheckoutUpdateMapper();
    }

    /**
     * @return \Spryker\Glue\CheckoutRestApi\Processor\Customer\CustomerMapperInterface
     */
    public function createCustomerMapper(): CustomerMapperInterface
    {
        return new CustomerMapper();
    }
}
