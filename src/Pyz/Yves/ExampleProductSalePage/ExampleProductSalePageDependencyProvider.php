<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\ExampleProductSalePage;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class ExampleProductSalePageDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_SEARCH = 'CLIENT_SEARCH';

    public const CLIENT_URL_STORAGE = 'CLIENT_URL_STORAGE';

    public const CLIENT_STORE = 'CLIENT_STORE';

    public const PLUGIN_PRODUCT_SALE_PAGE_WIDGETS = 'PLUGIN_PRODUCT_SALE_PAGE_WIDGETS';

    public const CLIENT_CATALOG = 'CLIENT_CATALOG';

    public const CLIENT_LOCALE = 'CLIENT_LOCALE';

    public const SERVICE_UTIL_NUMBER = 'SERVICE_UTIL_NUMBER';

    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);
        $container = $this->addSearchClient($container);
        $container = $this->addUrlStorageClient($container);
        $container = $this->addClientStore($container);
        $container = $this->addProductSalePageWidgetPlugins($container);
        $container = $this->addCatalogClient($container);
        $container = $this->addLocaleClient($container);
        $container = $this->addUtilNumberService($container);

        return $container;
    }

    protected function addSearchClient(Container $container): Container
    {
        $container->set(static::CLIENT_SEARCH, function (Container $container) {
            return $container->getLocator()->search()->client();
        });

        return $container;
    }

    protected function addUrlStorageClient(Container $container): Container
    {
        $container->set(static::CLIENT_URL_STORAGE, function (Container $container) {
            return $container->getLocator()->urlStorage()->client();
        });

        return $container;
    }

    protected function addClientStore(Container $container): Container
    {
        $container->set(static::CLIENT_STORE, function (Container $container) {
            return $container->getLocator()->store()->client();
        });

        return $container;
    }

    protected function addCatalogClient(Container $container): Container
    {
        $container->set(static::CLIENT_CATALOG, function (Container $container) {
            return $container->getLocator()->catalog()->client();
        });

        return $container;
    }

    protected function addProductSalePageWidgetPlugins(Container $container): Container
    {
        $container->set(static::PLUGIN_PRODUCT_SALE_PAGE_WIDGETS, function () {
            return $this->getProductSalePageWidgetPlugins();
        });

        return $container;
    }

    protected function addLocaleClient(Container $container): Container
    {
        $container->set(static::CLIENT_LOCALE, function (Container $container) {
            return $container->getLocator()->locale()->client();
        });

        return $container;
    }

    protected function addUtilNumberService(Container $container): Container
    {
        $container->set(static::SERVICE_UTIL_NUMBER, function (Container $container) {
            return $container->getLocator()->utilNumber()->service();
        });

        return $container;
    }

    /**
     * @return array<string>
     */
    protected function getProductSalePageWidgetPlugins(): array
    {
        return [];
    }
}
