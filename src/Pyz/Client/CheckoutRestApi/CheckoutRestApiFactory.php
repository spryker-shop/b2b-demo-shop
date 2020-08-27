<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\CheckoutRestApi;

use Pyz\Client\CheckoutRestApi\Zed\CheckoutRestApiZedStub;
use Spryker\Client\CheckoutRestApi\CheckoutRestApiFactory as SprykerCheckoutRestApiFactory;
use Spryker\Client\CheckoutRestApi\Zed\CheckoutRestApiZedStubInterface;

class CheckoutRestApiFactory extends SprykerCheckoutRestApiFactory
{
    /**
     * @return \Pyz\Client\CheckoutRestApi\Zed\CheckoutRestApiZedStubInterface
     */
    public function createCheckoutRestApiZedStub(): CheckoutRestApiZedStubInterface
    {
        return new CheckoutRestApiZedStub($this->getZedRequestClient());
    }
}
