<?php

namespace Pyz\Zed\ProductOfferShipmentTypeStorage;

use Spryker\Zed\MerchantProductOfferStorage\Communication\Plugin\ProductOfferShipmentTypeStorage\MerchantProductOfferShipmentTypeStorageFilterPlugin;
use Spryker\Zed\ProductOfferShipmentTypeStorage\ProductOfferShipmentTypeStorageDependencyProvider as SprykerProductOfferShipmentTypeStorageDependencyProvider;

class ProductOfferShipmentTypeStorageDependencyProvider extends SprykerProductOfferShipmentTypeStorageDependencyProvider
{
    protected function getProductOfferShipmentTypeStorageFilterPlugins(): array
    {
        return [
            new MerchantProductOfferShipmentTypeStorageFilterPlugin(),
        ];
    }
}
