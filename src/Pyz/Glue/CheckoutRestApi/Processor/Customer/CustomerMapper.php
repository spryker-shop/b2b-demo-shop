<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Glue\CheckoutRestApi\Processor\Customer;

use Spryker\Glue\CheckoutRestApi\Processor\Customer\CustomerMapper as SprykerCustomerMapper;
use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCustomerTransfer;
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
