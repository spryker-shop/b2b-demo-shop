<?php



declare(strict_types = 1);

namespace Pyz\Zed\CheckoutRestApi;

use Spryker\Zed\CheckoutRestApi\CheckoutRestApiConfig as SprykerCheckoutRestApiConfig;

class CheckoutRestApiConfig extends SprykerCheckoutRestApiConfig
{
    /**
     * @return bool
     */
    public function shouldExecuteQuotePostRecalculationPlugins(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isRecalculationEnabledForQuoteMapperPlugins(): bool
    {
        return false;
    }
}
