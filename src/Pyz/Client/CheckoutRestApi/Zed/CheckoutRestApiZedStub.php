<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\CheckoutRestApi\Zed;

use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer;
use Spryker\Client\CheckoutRestApi\Zed\CheckoutRestApiZedStub as SprykerCheckoutRestApiZedStub;

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
