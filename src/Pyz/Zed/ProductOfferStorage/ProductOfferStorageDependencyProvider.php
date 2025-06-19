<?php

namespace Pyz\Zed\ProductOfferStorage;

use Spryker\Zed\MerchantProductOfferStorage\Communication\Plugin\ProductOfferStorage\MerchantProductOfferStorageMapperPlugin;
use Spryker\Zed\ProductOfferStorage\ProductOfferStorageDependencyProvider as SprykerProductOfferStorageDependencyProvider;

class ProductOfferStorageDependencyProvider extends SprykerProductOfferStorageDependencyProvider
{
    protected function getProductOfferStorageMapperPlugins(): array
    {
        return [
            new MerchantProductOfferStorageMapperPlugin(),
        ];
    }
}
