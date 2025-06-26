<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ProductOfferStorage;

use Spryker\Zed\MerchantProductOfferStorage\Communication\Plugin\ProductOfferStorage\MerchantProductOfferStorageMapperPlugin;
use Spryker\Zed\MerchantStorage\Communication\Plugin\ProductOfferStorage\MerchantProductOfferStorageFilterPlugin;
use Spryker\Zed\ProductOfferStorage\ProductOfferStorageDependencyProvider as SprykerProductOfferStorageDependencyProvider;

class ProductOfferStorageDependencyProvider extends SprykerProductOfferStorageDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\ProductOfferStorageExtension\Dependency\Plugin\ProductOfferStorageFilterPluginInterface>
     */
    protected function getProductOfferStorageFilterPlugins(): array
    {
        return [
            new MerchantProductOfferStorageFilterPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductOfferStorageExtension\Dependency\Plugin\ProductOfferStorageMapperPluginInterface>
     */
    protected function getProductOfferStorageMapperPlugins(): array
    {
        return [
            new MerchantProductOfferStorageMapperPlugin(),
        ];
    }
}
