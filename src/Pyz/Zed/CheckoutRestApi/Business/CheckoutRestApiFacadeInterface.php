<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CheckoutRestApi\Business;

use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer;
use Spryker\Zed\CheckoutRestApi\Business\CheckoutRestApiFacadeInterface as SprykerCheckoutRestApiFacadeInterface;

interface CheckoutRestApiFacadeInterface extends SprykerCheckoutRestApiFacadeInterface
{
    /**
     * Specification:
     * - Provides checkout data based on data passed in RestCheckoutRequestAttributesTransfer.
     * - Checkout data will include current Quote.
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
