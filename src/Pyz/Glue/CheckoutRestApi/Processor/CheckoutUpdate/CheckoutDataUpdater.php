<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\CheckoutRestApi\Processor\CheckoutUpdate;

use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutUpdateResponseAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer;
use Generated\Shared\Transfer\RestErrorCollectionTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Pyz\Client\CheckoutRestApi\CheckoutRestApiClientInterface;
use Pyz\Glue\CheckoutRestApi\CheckoutRestApiConfig;
use Spryker\Glue\CheckoutRestApi\Processor\Error\RestCheckoutErrorMapperInterface;
use Spryker\Glue\CheckoutRestApi\Processor\RequestAttributesExpander\CheckoutRequestAttributesExpanderInterface;
use Spryker\Glue\CheckoutRestApi\Processor\Validator\CheckoutRequestValidatorInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\Response;

class CheckoutDataUpdater implements CheckoutDataUpdaterInterface
{
    /**
     * @var \Pyz\Client\CheckoutRestApi\CheckoutRestApiClientInterface
     */
    protected $checkoutRestApiClient;

    /**
     * @var \Pyz\Glue\CheckoutRestApi\Processor\CheckoutUpdate\CheckoutDataUpdaterInterface
     */
    protected $checkoutUpdateMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \Spryker\Glue\CheckoutRestApi\Processor\RequestAttributesExpander\CheckoutRequestAttributesExpanderInterface
     */
    protected $checkoutRequestAttributesExpander;

    /**
     * @var \Spryker\Glue\CheckoutRestApi\Processor\Validator\CheckoutRequestValidatorInterface
     */
    protected $checkoutRequestValidator;

    /**
     * @var \Spryker\Glue\CheckoutRestApi\Processor\Error\RestCheckoutErrorMapperInterface
     */
    protected $restCheckoutErrorMapper;

    /**
     * @param \Pyz\Client\CheckoutRestApi\CheckoutRestApiClientInterface $checkoutRestApiClient
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \Pyz\Glue\CheckoutRestApi\Processor\CheckoutUpdate\CheckoutDataUpdaterInterface $checkoutUpdateMapper
     * @param \Spryker\Glue\CheckoutRestApi\Processor\RequestAttributesExpander\CheckoutRequestAttributesExpanderInterface $checkoutRequestAttributesExpander
     * @param \Spryker\Glue\CheckoutRestApi\Processor\Validator\CheckoutRequestValidatorInterface $checkoutRequestValidator
     * @param \Spryker\Glue\CheckoutRestApi\Processor\Error\RestCheckoutErrorMapperInterface $restCheckoutErrorMapper
     */
    public function __construct(
        CheckoutRestApiClientInterface $checkoutRestApiClient,
        RestResourceBuilderInterface $restResourceBuilder,
        CheckoutUpdateMapperInterface $checkoutUpdateMapper,
        CheckoutRequestAttributesExpanderInterface $checkoutRequestAttributesExpander,
        CheckoutRequestValidatorInterface $checkoutRequestValidator,
        RestCheckoutErrorMapperInterface $restCheckoutErrorMapper
    ) {
        $this->checkoutRestApiClient = $checkoutRestApiClient;
        $this->restResourceBuilder = $restResourceBuilder;
        $this->checkoutUpdateMapper = $checkoutUpdateMapper;
        $this->checkoutRequestAttributesExpander = $checkoutRequestAttributesExpander;
        $this->checkoutRequestValidator = $checkoutRequestValidator;
        $this->restCheckoutErrorMapper = $restCheckoutErrorMapper;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function updateCheckoutData(
        RestRequestInterface $restRequest,
        RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
    ): RestResponseInterface {
        $restErrorCollectionTransfer = $this->checkoutRequestValidator->validateCheckoutRequest(
            $restRequest,
            $restCheckoutRequestAttributesTransfer
        );

        if ($restErrorCollectionTransfer->getRestErrors()->count()) {
            return $this->createValidationErrorResponse($restErrorCollectionTransfer);
        }

        $restCheckoutRequestAttributesTransfer = $this->checkoutRequestAttributesExpander
            ->expandCheckoutRequestAttributes($restRequest, $restCheckoutRequestAttributesTransfer);

        $restCheckoutUpdateResponseTransfer = $this
            ->checkoutRestApiClient
            ->updateCheckoutData($restCheckoutRequestAttributesTransfer);

        if (!$restCheckoutUpdateResponseTransfer->getIsSuccess()) {
            return $this->createCheckoutUpdateErrorResponse($restCheckoutUpdateResponseTransfer);
        }

        $restCheckoutUpdateResponseAttributesTransfer = $this->checkoutUpdateMapper
            ->mapRestCheckoutDataTransferToRestCheckoutUpdateResponseAttributesTransfer(
                $restCheckoutUpdateResponseTransfer->getQuote(),
                $restCheckoutRequestAttributesTransfer
            );

        return $this->createRestResponse($restCheckoutUpdateResponseAttributesTransfer, $restCheckoutUpdateResponseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCheckoutUpdateResponseAttributesTransfer $restCheckoutUpdateResponseAttributesTransfer
     * @param \Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer $restCheckoutUpdateResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createRestResponse(
        RestCheckoutUpdateResponseAttributesTransfer $restCheckoutUpdateResponseAttributesTransfer,
        RestCheckoutUpdateResponseTransfer $restCheckoutUpdateResponseTransfer
    ): RestResponseInterface {
        $checkoutDataResource = $this->restResourceBuilder->createRestResource(
            CheckoutRestApiConfig::RESOURCE_CHECKOUT_UPDATE,
            null,
            $restCheckoutUpdateResponseAttributesTransfer
        );

        $checkoutDataResource->setPayload($restCheckoutUpdateResponseTransfer);

        $restResponse = $this->restResourceBuilder
            ->createRestResponse()
            ->addResource($checkoutDataResource)
            ->setStatus(Response::HTTP_OK);

        return $restResponse;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer $restCheckoutUpdateResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createCheckoutUpdateErrorResponse(RestCheckoutUpdateResponseTransfer $restCheckoutUpdateResponseTransfer): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();
        foreach ($restCheckoutUpdateResponseTransfer->getErrors() as $restCheckoutErrorTransfer) {
            $restResponse->addError(
                $this->restCheckoutErrorMapper->mapRestCheckoutErrorTransferToRestErrorTransfer(
                    $restCheckoutErrorTransfer,
                    new RestErrorMessageTransfer()
                )
            );
        }

        return $restResponse;
    }

    /**
     * @param \Generated\Shared\Transfer\RestErrorCollectionTransfer $restErrorCollectionTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createValidationErrorResponse(RestErrorCollectionTransfer $restErrorCollectionTransfer)
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();
        foreach ($restErrorCollectionTransfer->getRestErrors() as $restErrorMessageTransfer) {
            $restResponse->addError($restErrorMessageTransfer);
        }

        return $restResponse;
    }
}
