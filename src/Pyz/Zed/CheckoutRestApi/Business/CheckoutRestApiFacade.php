<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CheckoutRestApi\Business;

use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer;
use Spryker\Zed\CheckoutRestApi\Business\CheckoutRestApiFacade as SprykerCheckoutRestApiFacade;

/**
 * @method \Pyz\Zed\CheckoutRestApi\Business\CheckoutRestApiBusinessFactory getFactory()
 */
class CheckoutRestApiFacade extends SprykerCheckoutRestApiFacade implements CheckoutRestApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer
     */
    public function updateCheckoutData(RestCheckoutRequestAttributesTransfer $restCheckoutRequestAttributesTransfer): RestCheckoutUpdateResponseTransfer
    {
        return $this->getFactory()
            ->createCheckoutDataWriter()
            ->updateCheckoutData($restCheckoutRequestAttributesTransfer);
    }
}
