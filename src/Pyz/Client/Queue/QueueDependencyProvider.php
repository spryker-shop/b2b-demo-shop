<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Client\Queue;

use Spryker\Client\Kernel\Container;
use Spryker\Client\Queue\QueueDependencyProvider as BaseQueueDependencyProvider;

class QueueDependencyProvider extends BaseQueueDependencyProvider
{
    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return array<\Spryker\Client\Queue\Model\Adapter\AdapterInterface>
     */
    protected function createQueueAdapters(Container $container): array // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        return [
            $container->getLocator()->rabbitMq()->client()->createQueueAdapter(),
        ];
    }
}
