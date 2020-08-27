<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Client\CheckoutRestApi;

use Spryker\Client\CheckoutRestApi\CheckoutRestApiFactory as SprykerCheckoutRestApiFactory;
use Spryker\Client\CheckoutRestApi\Dependency\Client\CheckoutRestApiToZedRequestClientInterface;
use Pyz\Client\CheckoutRestApi\Zed\CheckoutRestApiZedStub;
use Pyz\Client\CheckoutRestApi\Zed\CheckoutRestApiZedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CheckoutRestApiFactory extends SprykerCheckoutRestApiFactory
{
    /**
     * @return \Pyz\Client\CheckoutRestApi\Zed\CheckoutRestApiZedStubInterface
     */
    public function createCheckoutRestApiZedStub(): \Spryker\Client\CheckoutRestApi\Zed\CheckoutRestApiZedStubInterface
    {
        return new CheckoutRestApiZedStub($this->getZedRequestClient());
    }
}
