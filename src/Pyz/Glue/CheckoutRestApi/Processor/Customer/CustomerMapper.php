<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\CheckoutRestApi\Processor\Customer;

use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCustomerTransfer;
use Spryker\Glue\CheckoutRestApi\Processor\Customer\CustomerMapper as SprykerCustomerMapper;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomerMapper extends SprykerCustomerMapper
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCustomerTransfer
     */
    public function mapRestCustomerTransferFromRestCheckoutRequest(
        RestRequestInterface $restRequest,
        RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
    ): RestCustomerTransfer {
        $restCustomerTransfer = parent::mapRestCustomerTransferFromRestCheckoutRequest($restRequest, $restCheckoutRequestAttributesTransfer);
        $restCustomerTransfer->setUuidCompanyUser($restRequest->getRestUser()->getUuidCompanyUser());

        return $restCustomerTransfer;
    }
}
