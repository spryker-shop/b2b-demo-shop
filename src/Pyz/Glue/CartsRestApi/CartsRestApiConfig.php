<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Glue\CartsRestApi;

use Spryker\Glue\CartsRestApi\CartsRestApiConfig as SprykerCartsRestApiConfig;

class CartsRestApiConfig extends SprykerCartsRestApiConfig
{
    /**
     * @var bool
     */
    protected const ALLOWED_CART_ITEM_EAGER_RELATIONSHIP = false;

    /**
     * @var bool
     */
    protected const ALLOWED_GUEST_CART_ITEM_EAGER_RELATIONSHIP = false;
}
