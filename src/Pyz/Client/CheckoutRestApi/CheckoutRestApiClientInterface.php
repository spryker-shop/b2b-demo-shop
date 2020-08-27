<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\CheckoutRestApi;

use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer;
use Spryker\Client\CheckoutRestApi\CheckoutRestApiClientInterface as SpykerCheckoutRestApiClientInterface;

interface CheckoutRestApiClientInterface extends SpykerCheckoutRestApiClientInterface
{
    /**
     * Specification:
     * - Makes Zed request.
     * - Provides user checkout data based on data passed in RestCheckoutRequestAttributesTransfer.
     * - Checkout data will include stored Quote.
     * - Recalculates quote.
     * - Saves quote.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer
     */
    public function updateCheckoutData(RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer): RestCheckoutUpdateResponseTransfer;
}
