<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ProductOfferServicePointStorage;

use Spryker\Zed\MerchantProductOfferStorage\Communication\Plugin\ProductOfferServicePointStorage\MerchantProductOfferServiceCollectionStorageFilterPlugin;
use Spryker\Zed\ProductOfferServicePointStorage\ProductOfferServicePointStorageDependencyProvider as SprykerProductOfferServicePointStorageDependencyProvider;

class ProductOfferServicePointStorageDependencyProvider extends SprykerProductOfferServicePointStorageDependencyProvider
{
    /**
     * @return list<\Spryker\Zed\ProductOfferServicePointStorageExtension\Dependency\Plugin\ProductOfferServiceCollectionStorageFilterPluginInterface>
     */
    protected function getProductOfferServiceCollectionStorageFilterPlugins(): array
    {
        return [
            new MerchantProductOfferServiceCollectionStorageFilterPlugin(),
        ];
    }
}
