<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CheckoutRestApi\Communication\Controller;

use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer;
use Spryker\Zed\CheckoutRestApi\Communication\Controller\GatewayController as SprykerGatewayController;

/**
 * @method \Pyz\Zed\CheckoutRestApi\Business\CheckoutRestApiFacadeInterface getFacade()
 */
class GatewayController extends SprykerGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer
     */
    public function updateCheckoutDataAction(RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer): RestCheckoutUpdateResponseTransfer
    {
        return $this->getFacade()->updateCheckoutData($restCheckoutRequestAttributesTransfer);
    }
}
