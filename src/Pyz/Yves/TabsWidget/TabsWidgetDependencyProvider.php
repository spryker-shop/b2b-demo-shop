<?php



declare(strict_types = 1);

namespace Pyz\Yves\TabsWidget;

use SprykerShop\Yves\CatalogPage\Plugin\FullTextSearchProductsTabPlugin;
use SprykerShop\Yves\CmsSearchPage\Plugin\FullTextSearchCmsPageTabPlugin;
use SprykerShop\Yves\TabsWidget\TabsWidgetDependencyProvider as SprykerTabsWidgetDependencyProvider;

class TabsWidgetDependencyProvider extends SprykerTabsWidgetDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\TabsWidgetExtension\Plugin\FullTextSearchTabPluginInterface>
     */
    protected function createFullTextSearchPlugins(): array
    {
        return [
            new FullTextSearchProductsTabPlugin(),
            new FullTextSearchCmsPageTabPlugin(),
        ];
    }
}
