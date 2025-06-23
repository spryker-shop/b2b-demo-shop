<?php

namespace Pyz\Client\ProductOfferStorage;

use Spryker\Client\MerchantProductStorage\Plugin\ProductOfferStorage\MerchantProductProductOfferReferenceStrategyPlugin;
use Spryker\Client\MerchantStorage\Plugin\ProductOfferStorage\MerchantProductOfferStorageExpanderPlugin;
use Spryker\Client\PriceProductOfferStorage\Plugin\ProductOfferStorage\PriceProductOfferStorageExpanderPlugin;
use Spryker\Client\ProductOfferServicePointStorage\Plugin\ProductOfferStorage\ServiceProductOfferStorageExpanderPlugin;
use Spryker\Client\ProductOfferShipmentTypeStorage\Plugin\ProductOfferStorage\ShipmentTypeProductOfferStorageExpanderPlugin;
use Spryker\Client\ProductOfferStorage\Plugin\ProductOfferStorage\DefaultProductOfferReferenceStrategyPlugin;
use Spryker\Client\ProductOfferStorage\Plugin\ProductOfferStorage\ProductOfferReferenceStrategyPlugin;
use Spryker\Client\ProductOfferStorage\ProductOfferStorageDependencyProvider as SprykerProductOfferStorageDependencyProvider;

class ProductOfferStorageDependencyProvider extends SprykerProductOfferStorageDependencyProvider
{
    protected function getProductOfferStorageExpanderPlugins(): array
    {
        return [
            new PriceProductOfferStorageExpanderPlugin(),
            new MerchantProductOfferStorageExpanderPlugin(),
            new ServiceProductOfferStorageExpanderPlugin(),
            new ShipmentTypeProductOfferStorageExpanderPlugin(),
        ];
    }
    /**
     * @return array<\Spryker\Client\ProductOfferStorageExtension\Dependency\Plugin\ProductOfferReferenceStrategyPluginInterface>
     */
    protected function getProductOfferReferenceStrategyPlugins(): array
    {
        return [
            new ProductOfferReferenceStrategyPlugin(),
            new DefaultProductOfferReferenceStrategyPlugin(),
        ];
    }
}
