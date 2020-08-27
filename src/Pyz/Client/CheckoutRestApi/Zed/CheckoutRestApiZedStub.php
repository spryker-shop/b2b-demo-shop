<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Client\CheckoutRestApi\Zed;

use Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer;
use Spryker\Client\CheckoutRestApi\Zed\CheckoutRestApiZedStub as SprykerCheckoutRestApiZedStub;
use Generated\Shared\Transfer\RestCheckoutDataResponseTransfer;
use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutResponseTransfer;
use Spryker\Client\CheckoutRestApi\Dependency\Client\CheckoutRestApiToZedRequestClientInterface;

class CheckoutRestApiZedStub extends SprykerCheckoutRestApiZedStub implements CheckoutRestApiZedStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer
     */
    public function updateCheckoutData(RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer): RestCheckoutUpdateResponseTransfer
    {
        /** @var \Generated\Shared\Transfer\RestCheckoutDataResponseTransfer $restCheckoutDataResponseTransfer */
        $restCheckoutDataResponseTransfer = $this->zedRequestClient->call('/checkout-rest-api/gateway/update-checkout-data', $restCheckoutRequestAttributesTransfer);

        return $restCheckoutDataResponseTransfer;
    }
}
