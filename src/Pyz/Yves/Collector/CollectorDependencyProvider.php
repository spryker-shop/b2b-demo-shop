<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\Collector;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;
use Spryker\Yves\Kernel\Plugin\Pimple;
use SprykerShop\Yves\CatalogPage\Plugin\CatalogPageResourceCreator;
use SprykerShop\Yves\CmsPage\Plugin\PageResourceCreator;
use SprykerShop\Yves\ProductDetailPage\Plugin\ProductDetailPageResourceCreator;
use SprykerShop\Yves\ProductSetDetailPage\Plugin\ProductSetDetailPageResourceCreatorPlugin;
use SprykerShop\Yves\RedirectPage\Plugin\RedirectResourceCreator;

class CollectorDependencyProvider extends AbstractBundleDependencyProvider
{
    const SERVICE_UTIL_DATE_TIME = 'util date time service';

    const SERVICE_NETWORK = 'util network service';

    const SERVICE_UTIL_IO = 'util io service';

    const SERVICE_DATA = 'util data service';

    const CLIENT_COLLECTOR = 'collector client';
    const CLIENT_CATALOG = 'client client';
    const PLUGIN_APPLICATION = 'application plugin';
    const PLUGIN_CATALOG_PAGE_RESOURCE_CREATOR = 'PLUGIN_CATALOG_PAGE_RESOURCE_CREATOR';
    const PLUGIN_PAGE_RESOURCE_CREATOR = 'PLUGIN_PAGE_RESOURCE_CREATOR';
    const PLUGIN_PRODUCT_DETAIL_PAGE_RESOURCE_CREATOR = 'PLUGIN_PRODUCT_DETAIL_PAGE_RESOURCE_CREATOR';
    const PLUGIN_REDIRECT_RESOURCE_CREATOR = 'PLUGIN_REDIRECT_RESOURCE_CREATOR';
    const PLUGIN_PRODUCT_SET_RESOURCE_CREATOR = 'PLUGIN_PRODUCT_SET_RESOURCE_CREATOR';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = $this->provideClients($container);
        $container = $this->providePlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function provideClients(Container $container)
    {
        $container[self::CLIENT_COLLECTOR] = function (Container $container) {
            return $container->getLocator()->collector()->client();
        };

        $container[self::CLIENT_CATALOG] = function (Container $container) {
            return $container->getLocator()->catalog()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function providePlugins(Container $container)
    {
        $container[self::PLUGIN_APPLICATION] = function () {
            $pimplePlugin = new Pimple();

            return $pimplePlugin->getApplication();
        };

        $container[self::PLUGIN_CATALOG_PAGE_RESOURCE_CREATOR] = function () {
            $catalogPageResourceCreatorPlugin = new CatalogPageResourceCreator();

            return $catalogPageResourceCreatorPlugin->createCategoryResourceCreator();
        };

        $container[self::PLUGIN_REDIRECT_RESOURCE_CREATOR] = function () {
            $redirectResourceCreatorPlugin = new RedirectResourceCreator();

            return $redirectResourceCreatorPlugin->createRedirectResourceCreator();
        };

        $container[self::PLUGIN_PAGE_RESOURCE_CREATOR] = function () {
            $pageResourceCreatorPlugin = new PageResourceCreator();

            return $pageResourceCreatorPlugin->createPageResourceCreator();
        };

        $container[self::PLUGIN_PRODUCT_DETAIL_PAGE_RESOURCE_CREATOR] = function () {
            $productResourceCreatorPlugin = new ProductDetailPageResourceCreator();

            return $productResourceCreatorPlugin->createProductResourceCreator();
        };

        $container[self::PLUGIN_PRODUCT_SET_RESOURCE_CREATOR] = function () {
            $productSetDetailPageResourceCreatorPlugin = new ProductSetDetailPageResourceCreatorPlugin();

            return $productSetDetailPageResourceCreatorPlugin->createProductSetDetailPageResourceCreator();
        };

        return $container;
    }
}
