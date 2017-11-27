<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\Catalog;

use Spryker\Client\Catalog\CatalogFactory as SprykerCatalogFactory;

class CatalogFactory extends SprykerCatalogFactory
{

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function getFeaturedProductsQueryExpanderPlugins()
    {
        return $this->getProvidedDependency(CatalogDependencyProvider::FEATURED_PRODUCTS_QUERY_EXPANDER_PLUGINS);
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    public function getFeaturedProductsResultFormatters()
    {
        return $this->getProvidedDependency(CatalogDependencyProvider::FEATURED_PRODUCTS_RESULT_FORMATTER_PLUGINS);
    }
}
