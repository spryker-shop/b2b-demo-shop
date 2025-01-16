<?php



declare(strict_types = 1);

namespace Pyz\Yves\SalesReturnPage;

use SprykerShop\Yves\SalesProductBundleWidget\Plugin\SalesReturnPage\ProductBundleReturnCreateFormHandlerPlugin;
use SprykerShop\Yves\SalesReturnPage\SalesReturnPageDependencyProvider as SprykerSalesReturnPageDependencyProvider;

class SalesReturnPageDependencyProvider extends SprykerSalesReturnPageDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\SalesReturnPageExtension\Dependency\Plugin\ReturnCreateFormHandlerPluginInterface>
     */
    protected function getReturnCreateFormHandlerPlugins(): array
    {
        return [
            new ProductBundleReturnCreateFormHandlerPlugin(),
        ];
    }
}
