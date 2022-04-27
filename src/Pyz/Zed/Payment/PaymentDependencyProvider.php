<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Payment;

use Spryker\Zed\OauthClient\Communication\Plugin\Payment\AccessTokenPaymentAuthorizeRequestExpanderPlugin;
use Spryker\Zed\Payment\PaymentDependencyProvider as SprykerPaymentDependencyProvider;

class PaymentDependencyProvider extends SprykerPaymentDependencyProvider
{
    /**
     * @return array<int, \Spryker\Zed\PaymentExtension\Dependency\Plugin\PaymentAuthorizeRequestExpanderPluginInterface>
     */
    protected function getPaymentAuthorizeRequestExpanderPlugins(): array
    {
        return [
            new AccessTokenPaymentAuthorizeRequestExpanderPlugin(),
        ];
    }
}
