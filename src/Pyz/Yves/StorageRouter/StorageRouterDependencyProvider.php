<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\StorageRouter;

use SprykerShop\Yves\CatalogPage\Plugin\StorageRouter\CatalogPageResourceCreatorPlugin;
use SprykerShop\Yves\CmsPage\Plugin\StorageRouter\PageResourceCreatorPlugin;
use SprykerShop\Yves\ProductDetailPage\Plugin\StorageRouter\ProductDetailPageResourceCreatorPlugin;
use SprykerShop\Yves\ProductSetDetailPage\Plugin\StorageRouter\ProductSetDetailPageResourceCreatorPlugin;
use SprykerShop\Yves\RedirectPage\Plugin\StorageRouter\RedirectResourceCreatorPlugin;
use SprykerShop\Yves\StorageRouter\Plugin\RouterEnhancer\StorePrefixStorageRouterEnhancerPlugin;
use SprykerShop\Yves\StorageRouter\StorageRouterDependencyProvider as SprykerShopStorageRouterDependencyProvider;

class StorageRouterDependencyProvider extends SprykerShopStorageRouterDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\StorageRouterExtension\Dependency\Plugin\ResourceCreatorPluginInterface>
     */
    protected function getResourceCreatorPlugins(): array
    {
        return [
            new PageResourceCreatorPlugin(),
            new CatalogPageResourceCreatorPlugin(),
            new ProductDetailPageResourceCreatorPlugin(),
            new ProductSetDetailPageResourceCreatorPlugin(),
            new RedirectResourceCreatorPlugin(),
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\StorageRouterExtension\Dependency\Plugin\StorageRouterEnhancerPluginInterface>
     */
    protected function getStorageRouterEnhancerPlugins(): array
    {
        return [
            new StorePrefixStorageRouterEnhancerPlugin(),
        ];
    }
}
