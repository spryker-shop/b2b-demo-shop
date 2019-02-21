<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Checkout;

use Spryker\Client\Checkout\CheckoutDependencyProvider as SprykerCheckoutDependencyProvider;
use Spryker\Client\QuoteApproval\Plugin\Checkout\QuoteApprovalCheckoutPreCheckPlugin;

class CheckoutDependencyProvider extends SprykerCheckoutDependencyProvider
{
    /**
     * @return \Spryker\Client\CheckoutExtension\Dependency\Plugin\CheckoutPreCheckPluginInterface[]
     */
    protected function getCheckoutPreCheckPlugins(): array
    {
        return [
            new QuoteApprovalCheckoutPreCheckPlugin(),
        ];
    }
}
