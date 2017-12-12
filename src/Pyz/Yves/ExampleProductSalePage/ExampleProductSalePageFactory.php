<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ExampleProductSalePage;

use Spryker\Client\Collector\CollectorClient;
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
     * @return \Spryker\Client\Collector\CollectorClientInterface
     */
    public function getCollectorClient()
    {
        return new CollectorClient(); // TODO: get from dependency provider
    }

    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    public function getStore()
    {
        return $this->getProvidedDependency(ExampleProductSalePageDependencyProvider::STORE);
    }
}
