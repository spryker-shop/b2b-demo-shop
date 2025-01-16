<?php



declare(strict_types = 1);

namespace Pyz\Zed\PaymentCartConnector;

use Spryker\Zed\PaymentCartConnector\PaymentCartConnectorConfig as SprykerPaymentCartConnectorConfig;

class PaymentCartConnectorConfig extends SprykerPaymentCartConnectorConfig
{
    /**
     * @var list<string>
     */
    protected const EXCLUDED_PAYMENT_METHODS = [
        'PayPal Express',
    ];
}
