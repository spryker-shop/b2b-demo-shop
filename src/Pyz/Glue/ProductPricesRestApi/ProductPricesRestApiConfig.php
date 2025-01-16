<?php



declare(strict_types = 1);

namespace Pyz\Glue\ProductPricesRestApi;

use Spryker\Glue\ProductPricesRestApi\ProductPricesRestApiConfig as SprykerProductPricesRestApiConfig;

class ProductPricesRestApiConfig extends SprykerProductPricesRestApiConfig
{
    /**
     * @var bool
     */
    protected const PERMISSION_CHECK_ENABLED = true;
}
