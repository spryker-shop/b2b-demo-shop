<?php

namespace Pyz\Zed\ProductOfferServicePointStorage;

use Spryker\Zed\MerchantProductOfferStorage\Communication\Plugin\ProductOfferServicePointStorage\MerchantProductOfferServiceCollectionStorageFilterPlugin;
use Spryker\Zed\ProductOfferServicePointStorage\ProductOfferServicePointStorageDependencyProvider as SprykerProductOfferServicePointStorageDependencyProvider;

class ProductOfferServicePointStorageDependencyProvider extends SprykerProductOfferServicePointStorageDependencyProvider
{
    protected function getProductOfferServiceCollectionStorageFilterPlugins(): array
    {
        return [
            new MerchantProductOfferServiceCollectionStorageFilterPlugin(),
        ];
    }
}
