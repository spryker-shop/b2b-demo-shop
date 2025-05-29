<?php

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
