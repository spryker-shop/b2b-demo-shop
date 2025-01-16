<?php



declare(strict_types = 1);

namespace Pyz\Zed\MessageBroker;

use Spryker\Zed\MessageBroker\MessageBrokerConfig as SprykerMessageBrokerConfig;

class MessageBrokerConfig extends SprykerMessageBrokerConfig
{
    /**
     * @return array<string>
     */
    public function getDefaultWorkerChannels(): array
    {
        return [
            'payment-events',
            'payment-method-commands',
            'asset-commands',
            'product-review-commands',
            'product-commands',
            'search-commands',
            'tax-commands',
        ];
    }
}
