<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ExampleProductSalePage;

use Spryker\Shared\Kernel\Store;
use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\CategoryWidget\Plugin\CategoryReaderPlugin;

class ExampleProductSalePageDependencyProvider extends AbstractBundleDependencyProvider
{
    const CLIENT_SEARCH = 'CLIENT_SEARCH';
    const PLUGIN_CATEGORY_READER = 'PLUGIN_CATEGORY_READER';
    const STORE = 'STORE';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = $this->addSearchClient($container);
        $container = $this->addCategoryReaderPlugin($container);
        $container = $this->addStore($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addSearchClient(Container $container)
    {
        $container[self::CLIENT_SEARCH] = function (Container $container) {
            return $container->getLocator()->search()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addCategoryReaderPlugin(Container $container)
    {
        $container[self::PLUGIN_CATEGORY_READER] = function (Container $container) {
            return new CategoryReaderPlugin();
        };

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addStore($container)
    {
        $container[self::STORE] = function (Container $container) {
            return Store::getInstance();
        };

        return $container;
    }
}
