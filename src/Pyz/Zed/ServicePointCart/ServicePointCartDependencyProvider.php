<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ServicePointCart;

use Spryker\Zed\ClickAndCollectExample\Communication\Plugin\ServicePointCart\ClickAndCollectExampleServicePointQuoteItemReplaceStrategyPlugin;
use Spryker\Zed\ServicePointCart\ServicePointCartDependencyProvider as SprykerServicePointCartDependencyProvider;

class ServicePointCartDependencyProvider extends SprykerServicePointCartDependencyProvider
{
    /**
     * @return list<\Spryker\Zed\ServicePointCartExtension\Dependency\Plugin\ServicePointQuoteItemReplaceStrategyPluginInterface>
     */
    protected function getServicePointQuoteItemReplaceStrategyPlugins(): array
    {
        return [
            new ClickAndCollectExampleServicePointQuoteItemReplaceStrategyPlugin(),
        ];
    }
}
