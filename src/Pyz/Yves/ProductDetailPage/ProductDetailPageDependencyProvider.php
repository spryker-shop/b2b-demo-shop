<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\ProductDetailPage;

use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\ProductDetailPage\ProductDetailPageDependencyProvider as SprykerShopProductDetailPageDependencyProvider;

class ProductDetailPageDependencyProvider extends SprykerShopProductDetailPageDependencyProvider
{
    public const CLIENT_PRODUCT_STORAGE_PYZ = 'CLIENT_PRODUCT_STORAGE_PYZ';

    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);
        $container = $this->addProductStoragePyzClient($container);

        return $container;
    }

    protected function addProductStoragePyzClient(Container $container): Container
    {
        $container->set(static::CLIENT_PRODUCT_STORAGE_PYZ, function (Container $container) {
            return $container->getLocator()->productStorage()->client();
        });

        return $container;
    }
}
