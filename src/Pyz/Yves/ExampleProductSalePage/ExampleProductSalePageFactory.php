<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ExampleProductSalePage;

use Spryker\Yves\Kernel\AbstractFactory;
use SprykerShop\Yves\ProductWidget\Plugin\CatalogPage\ProductWidgetPlugin;

class ExampleProductSalePageFactory extends AbstractFactory
{
    /**
     * @return string[]
     */
    public function getExampleProductSalePageWidgetPlugins(): array
    {
        // TODO: move to dependency provider
        return [
            // TODO: get from project level
            ProductWidgetPlugin::class,
        ];
    }

    /**
     * @return \Spryker\Client\Search\SearchClientInterface
     */
    protected function getSearchClient()
    {
        return $this->getProvidedDependency(ExampleProductSalePageDependencyProvider::CLIENT_SEARCH);
    }

    /**
     * @return \SprykerShop\Yves\CategoryWidget\Plugin\CategoryReaderPlugin
     */
    public function getCategoryReaderPlugin()
    {
        return $this->getProvidedDependency(ExampleProductSalePageDependencyProvider::PLUGIN_CATEGORY_READER);
    }
}
