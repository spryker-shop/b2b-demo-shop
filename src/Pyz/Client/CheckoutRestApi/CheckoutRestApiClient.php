<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\CheckoutRestApi;

use Generated\Shared\Transfer\RestCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutUpdateResponseTransfer;
use Spryker\Client\CheckoutRestApi\CheckoutRestApiClient as SpykerCheckoutRestApiClient;

/**
 * @method \Pyz\Client\CheckoutRestApi\CheckoutRestApiFactory getFactory()
 */
class CheckoutRestApiClient extends SpykerCheckoutRestApiClient implements CheckoutRestApiClientInterface
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
        return $this->getFactory()->createCheckoutRestApiZedStub()->updateCheckoutData($restCheckoutRequestAttributesTransfer);
    }
}
