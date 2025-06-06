<?php

namespace Pyz\Yves\ProductSearchWidget;

use SprykerShop\Yves\MerchantProductOfferWidget\Plugin\ProductSearchWidget\MerchantProductOfferProductQuickAddFormExpanderPlugin;
use SprykerShop\Yves\ProductSearchWidget\ProductSearchWidgetDependencyProvider as SprykerProductSearchWidgetDependencyProvider;

class ProductSearchWidgetDependencyProvider extends SprykerProductSearchWidgetDependencyProvider
{
    protected function getProductQuickAddFormExpanderPlugins(): array
    {
        return [
            new MerchantProductOfferProductQuickAddFormExpanderPlugin(),
        ];
    }
}
