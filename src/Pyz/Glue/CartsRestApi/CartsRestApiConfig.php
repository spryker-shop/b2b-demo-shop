<?php



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
