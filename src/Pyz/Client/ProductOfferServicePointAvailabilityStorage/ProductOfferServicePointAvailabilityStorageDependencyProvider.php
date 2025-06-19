<?php

namespace Pyz\Client\ProductOfferServicePointAvailabilityStorage;

use Spryker\Client\ProductOfferServicePointAvailabilityStorage\ProductOfferServicePointAvailabilityStorageDependencyProvider as SprykerProductOfferServicePointAvailabilityStorageDependencyProvider;
use Spryker\Client\ProductOfferShipmentTypeAvailabilityStorage\Plugin\ProductOfferServicePointAvailabilityStorage\ShipmentTypeProductOfferServicePointAvailabilityFilterPlugin;

class ProductOfferServicePointAvailabilityStorageDependencyProvider extends SprykerProductOfferServicePointAvailabilityStorageDependencyProvider
{
    protected function getProductOfferServicePointAvailabilityFilterPlugins(): array
    {
        return [
            new ShipmentTypeProductOfferServicePointAvailabilityFilterPlugin(),
        ];
    }
}
