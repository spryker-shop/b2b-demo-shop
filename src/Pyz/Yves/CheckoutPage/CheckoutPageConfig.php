<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CheckoutPage;

use SprykerShop\Yves\CheckoutPage\CheckoutPageConfig as SprykerCheckoutPageConfig;

class CheckoutPageConfig extends SprykerCheckoutPageConfig
{
    /**
     * @uses \SprykerShop\Yves\CheckoutPage\Plugin\Router\CheckoutPageRouteProviderPlugin::ROUTE_NAME_CHECKOUT_ERROR
     *
     * @var string|null
     */
    protected const SUCCESS_STEP_ESCAPE_ROUTE = 'checkout-error';

    /**
     * @return array<string>
     */
    public function getLocalizedTermsAndConditionsPageLinks(): array
    {
        return [
            'en_US' => '/en/gtc',
            'de_DE' => '/de/agb',
        ];
    }

    /**
     * @return string|null
     */
    public function getSuccessStepEscapeRoute(): ?string
    {
        return static::SUCCESS_STEP_ESCAPE_ROUTE;
    }
}
