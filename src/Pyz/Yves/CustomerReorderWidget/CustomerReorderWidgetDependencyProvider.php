<?php



declare(strict_types = 1);

namespace Pyz\Yves\CustomerReorderWidget;

use SprykerShop\Yves\CustomerReorderWidget\CustomerReorderWidgetDependencyProvider as SprykerShopCustomerReorderWidgetDependencyProvider;
use SprykerShop\Yves\ProductBundleWidget\Plugin\CustomerReorderWidget\ProductBundleReorderItemFetcherPlugin;
use SprykerShop\Yves\SalesConfigurableBundleWidget\Plugin\CustomerReorder\ConfiguredBundlePostReorderPlugin;
use SprykerShop\Yves\SalesProductConfigurationWidget\Plugin\CustomerReorderWidget\ProductConfigurationReorderItemExpanderPlugin;
use SprykerShop\Yves\SalesReturnPage\Plugin\CustomerReorderWidget\RemunerationAmountReorderItemSanitizerPlugin;

class CustomerReorderWidgetDependencyProvider extends SprykerShopCustomerReorderWidgetDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\CustomerReorderWidgetExtension\Dependency\Plugin\PostReorderPluginInterface>
     */
    protected function getPostReorderPlugins(): array
    {
        return [
            new ConfiguredBundlePostReorderPlugin(),
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\CustomerReorderWidgetExtension\Dependency\Plugin\ReorderItemSanitizerPluginInterface>
     */
    protected function getReorderItemSanitizerPlugins(): array
    {
        return [
            new RemunerationAmountReorderItemSanitizerPlugin(),
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\CustomerReorderWidgetExtension\Dependency\Plugin\ReorderItemFetcherPluginInterface>
     */
    protected function getReorderItemFetcherPlugins(): array
    {
        return [
            new ProductBundleReorderItemFetcherPlugin(),
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\CustomerReorderWidgetExtension\Dependency\Plugin\ReorderItemExpanderPluginInterface>
     */
    protected function getReorderItemExpanderPlugins(): array
    {
        return [
            new ProductConfigurationReorderItemExpanderPlugin(),
        ];
    }
}
