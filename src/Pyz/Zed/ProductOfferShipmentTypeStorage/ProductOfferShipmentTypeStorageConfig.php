<?php

namespace Pyz\Zed\ProductOfferShipmentTypeStorage;

use Pyz\Zed\Synchronization\SynchronizationConfig;
use Spryker\Zed\ProductOfferShipmentTypeStorage\ProductOfferShipmentTypeStorageConfig as SprykerProductOfferShipmentTypeStorageConfig;

class ProductOfferShipmentTypeStorageConfig extends SprykerProductOfferShipmentTypeStorageConfig
{
    public function getProductOfferShipmentTypeSynchronizationPoolName(): ?string
    {
        return SynchronizationConfig::DEFAULT_SYNCHRONIZATION_POOL_NAME;
    }
}
