<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\Collector;

use Pyz\Yves\Collector\Mapper\ParameterMerger;
use Pyz\Yves\Collector\Mapper\UrlMapper;
use Spryker\Yves\Kernel\AbstractFactory;

class CollectorFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Yves\Collector\Creator\ResourceCreatorInterface[]
     */
    public function getResourceCreators()
    {
        return [
            $this->getProductDetailPageResourceCreator(),
            $this->getCatalogPageResourceCreator(),
            $this->getRedirectResourceCreator(),
            $this->getPageResourceCreator(),
            $this->getProductSetDetailPageResourceCreator(),
        ];
    }

    /**
     * @return \Pyz\Yves\Collector\Mapper\UrlMapperInterface
     */
    public function createUrlMapper()
    {
        return new UrlMapper();
    }

    /**
     * @return \Pyz\Yves\Collector\Mapper\ParameterMergerInterface
     */
    public function createParameterMerger()
    {
        return new ParameterMerger();
    }

    /**
     * @return \Spryker\Client\Collector\Matcher\UrlMatcherInterface
     */
    public function getUrlMatcher()
    {
        return $this->getProvidedDependency(CollectorDependencyProvider::CLIENT_COLLECTOR);
    }

    /**
     * @return \Silex\Application
     */
    public function getApplication()
    {
        return $this->getProvidedDependency(CollectorDependencyProvider::PLUGIN_APPLICATION);
    }

    /**
     * @return \SprykerShop\Yves\ProductDetailPage\Plugin\ProductDetailPageResourceCreator
     */
    protected function getProductDetailPageResourceCreator()
    {
        return $this->getProvidedDependency(CollectorDependencyProvider::PLUGIN_PRODUCT_DETAIL_PAGE_RESOURCE_CREATOR);
    }

    /**
     * @return \SprykerShop\Yves\CatalogPage\Plugin\CatalogPageResourceCreator
     */
    protected function getCatalogPageResourceCreator()
    {
        return $this->getProvidedDependency(CollectorDependencyProvider::PLUGIN_CATALOG_PAGE_RESOURCE_CREATOR);
    }

    /**
     * @return \Pyz\Yves\Redirect\Plugin\RedirectResourceCreator
     */
    protected function getRedirectResourceCreator()
    {
        return $this->getProvidedDependency(CollectorDependencyProvider::PLUGIN_REDIRECT_RESOURCE_CREATOR);
    }

    /**
     * @return \Pyz\Yves\Cms\Plugin\PageResourceCreator
     */
    protected function getPageResourceCreator()
    {
        return $this->getProvidedDependency(CollectorDependencyProvider::PLUGIN_PAGE_RESOURCE_CREATOR);
    }

    /**
     * @return \SprykerShop\Yves\ProductSetDetailPage\ResourceCreator\ProductSetDetailPageResourceCreator
     */
    protected function getProductSetDetailPageResourceCreator()
    {
        return $this->getProvidedDependency(CollectorDependencyProvider::PLUGIN_PRODUCT_SET_RESOURCE_CREATOR);
    }
}
