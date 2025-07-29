<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Glue\UrlsRestApi;

use Spryker\Glue\CategoriesRestApi\Plugin\UrlsRestApi\CategoryNodeRestUrlResolverAttributesTransferProviderPlugin;
use Spryker\Glue\CmsPagesRestApi\Plugin\UrlsRestApi\CmsPageRestUrlResolverAttributesTransferProviderPlugin;
use Spryker\Glue\ProductsRestApi\Plugin\UrlsRestApi\ProductAbstractRestUrlResolverAttributesTransferProviderPlugin;
use Spryker\Glue\UrlsRestApi\UrlsRestApiDependencyProvider as SprykerUrlsRestApiDependencyProvider;

class UrlsRestApiDependencyProvider extends SprykerUrlsRestApiDependencyProvider
{
    /**
     * @return array<\Spryker\Glue\UrlsRestApiExtension\Dependency\Plugin\RestUrlResolverAttributesTransferProviderPluginInterface>
     */
    protected function getRestUrlResolverAttributesTransferProviderPlugins(): array
    {
        return [
            new ProductAbstractRestUrlResolverAttributesTransferProviderPlugin(),
            new CategoryNodeRestUrlResolverAttributesTransferProviderPlugin(),
            new CmsPageRestUrlResolverAttributesTransferProviderPlugin(),
        ];
    }
}
