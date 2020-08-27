<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Glue\CheckoutRestApi;

use Pyz\Glue\CheckoutRestApi\Processor\CheckoutUpdate\CheckoutDataUpdater;
use Pyz\Glue\CheckoutRestApi\Processor\CheckoutUpdate\CheckoutDataUpdaterInterface;
use Pyz\Glue\CheckoutRestApi\Processor\CheckoutUpdate\CheckoutUpdateMapper;
use Pyz\Glue\CheckoutRestApi\Processor\CheckoutUpdate\CheckoutUpdateMapperInterface;
use Spryker\Glue\CheckoutRestApi\CheckoutRestApiFactory as SprykerCheckoutRestApiFactory;
use Spryker\Glue\CheckoutRestApi\Dependency\Client\CheckoutRestApiToGlossaryStorageClientInterface;
use Spryker\Glue\CheckoutRestApi\Processor\Checkout\CheckoutProcessor;
use Spryker\Glue\CheckoutRestApi\Processor\Checkout\CheckoutProcessorInterface;
use Spryker\Glue\CheckoutRestApi\Processor\Checkout\CheckoutResponseMapper;
use Spryker\Glue\CheckoutRestApi\Processor\Checkout\CheckoutResponseMapperInterface;
use Spryker\Glue\CheckoutRestApi\Processor\CheckoutData\CheckoutDataMapper;
use Spryker\Glue\CheckoutRestApi\Processor\CheckoutData\CheckoutDataMapperInterface;
use Spryker\Glue\CheckoutRestApi\Processor\CheckoutData\CheckoutDataReader;
use Spryker\Glue\CheckoutRestApi\Processor\CheckoutData\CheckoutDataReaderInterface;
use Spryker\Glue\CheckoutRestApi\Processor\CheckoutData\CheckoutDataResponseMapper\AddressCheckoutDataResponseMapper;
use Spryker\Glue\CheckoutRestApi\Processor\CheckoutData\CheckoutDataResponseMapper\CheckoutDataResponseMapperInterface;
use Spryker\Glue\CheckoutRestApi\Processor\CheckoutData\CheckoutDataResponseMapper\PaymentProviderCheckoutDataResponseMapper;
use Spryker\Glue\CheckoutRestApi\Processor\CheckoutData\CheckoutDataResponseMapper\ShipmentMethodCheckoutDataResponseMapper;
use Spryker\Glue\CheckoutRestApi\Processor\Customer\CustomerMapper;
use Spryker\Glue\CheckoutRestApi\Processor\Customer\CustomerMapperInterface;
use Spryker\Glue\CheckoutRestApi\Processor\Error\RestCheckoutErrorMapper;
use Spryker\Glue\CheckoutRestApi\Processor\Error\RestCheckoutErrorMapperInterface;
use Spryker\Glue\CheckoutRestApi\Processor\RequestAttributesExpander\CheckoutRequestAttributesExpander;
use Spryker\Glue\CheckoutRestApi\Processor\RequestAttributesExpander\CheckoutRequestAttributesExpanderInterface;
use Spryker\Glue\CheckoutRestApi\Processor\Validator\CheckoutRequestValidator;
use Spryker\Glue\CheckoutRestApi\Processor\Validator\CheckoutRequestValidatorInterface;
use Spryker\Glue\CheckoutRestApi\Processor\Validator\SinglePaymentValidator;
use Spryker\Glue\CheckoutRestApi\Processor\Validator\SinglePaymentValidatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

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
}
