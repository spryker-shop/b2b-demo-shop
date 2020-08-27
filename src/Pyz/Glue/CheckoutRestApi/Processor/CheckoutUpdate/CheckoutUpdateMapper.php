<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Glue\CheckoutRestApi\Processor\CheckoutUpdate;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestAddressTransfer;
use Generated\Shared\Transfer\RestCheckoutDataResponseAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutDataTransfer;
use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutUpdateResponseAttributesTransfer;
use Generated\Shared\Transfer\RestCustomerTransfer;
use Generated\Shared\Transfer\RestPointOfContactTransfer;
use Generated\Shared\Transfer\RestShipmentTransfer;

class CheckoutUpdateMapper implements CheckoutUpdateMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCheckoutUpdateResponseAttributesTransfer
     */
    public function mapRestCheckoutDataTransferToRestCheckoutUpdateResponseAttributesTransfer(
        QuoteTransfer $quoteTransfer,
        RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
    ): RestCheckoutUpdateResponseAttributesTransfer {
        $restCheckoutUpdateResponseAttributesTransfer = new RestCheckoutUpdateResponseAttributesTransfer();
        $restCheckoutUpdateResponseAttributesTransfer->setCustomer(
            (new RestCustomerTransfer())->fromArray($quoteTransfer->getCustomer()->toArray(), true)
        );
        $restCheckoutUpdateResponseAttributesTransfer->setIdCart($restCheckoutRequestAttributesTransfer->getIdCart());
        $restCheckoutUpdateResponseAttributesTransfer->setBillingAddress(
            (new RestAddressTransfer())->fromArray($quoteTransfer->getBillingAddress()->toArray(), true)
        );
        $restCheckoutUpdateResponseAttributesTransfer->setShippingAddress(
            (new RestAddressTransfer())->fromArray($quoteTransfer->getShippingAddress()->toArray(), true)
        );
        $restCheckoutUpdateResponseAttributesTransfer->setPayments($restCheckoutRequestAttributesTransfer->getPayments());
        $restCheckoutUpdateResponseAttributesTransfer->setShipment($restCheckoutRequestAttributesTransfer->getShipment());
        $restCheckoutUpdateResponseAttributesTransfer->setPointOfContact(
            (new RestPointOfContactTransfer())->fromArray($quoteTransfer->getPointOfContact()->toArray(), true)
        );

        return $restCheckoutUpdateResponseAttributesTransfer;
    }
}
