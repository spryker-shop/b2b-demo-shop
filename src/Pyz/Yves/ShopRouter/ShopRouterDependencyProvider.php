<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\ShopRouter;

use SprykerShop\Yves\CatalogPage\Plugin\CatalogPageResourceCreatorPlugin;
use SprykerShop\Yves\CmsPage\Plugin\PageResourceCreatorPlugin;
use SprykerShop\Yves\ProductDetailPage\Plugin\ProductDetailPageResourceCreatorPlugin;
use SprykerShop\Yves\ProductSetDetailPage\Plugin\ProductSetDetailPageResourceCreatorPlugin;
use SprykerShop\Yves\RedirectPage\Plugin\RedirectResourceCreatorPlugin;
use SprykerShop\Yves\ShopRouter\Dependency\Plugin\ResourceCreatorPluginInterface;
use SprykerShop\Yves\ShopRouter\ShopRouterDependencyProvider as SprykerShopRouterDependencyProvider;

class ShopRouterDependencyProvider extends SprykerShopRouterDependencyProvider
{

    /**
     * @return ResourceCreatorPluginInterface[]
     */
    protected function getResourceCreatorPlugins()
    {
        return [
            new PageResourceCreatorPlugin(),
            new CatalogPageResourceCreatorPlugin(),
            new ProductDetailPageResourceCreatorPlugin(),
            new ProductSetDetailPageResourceCreatorPlugin(),
            new RedirectResourceCreatorPlugin(),
        ];
    }

}
