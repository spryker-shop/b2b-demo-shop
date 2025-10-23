<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Client\ProductOfferServicePointAvailabilityStorage;

use Spryker\Client\ProductOfferServicePointAvailabilityStorage\ProductOfferServicePointAvailabilityStorageDependencyProvider as SprykerProductOfferServicePointAvailabilityStorageDependencyProvider;
use Spryker\Client\ProductOfferShipmentTypeAvailabilityStorage\Plugin\ProductOfferServicePointAvailabilityStorage\ShipmentTypeProductOfferServicePointAvailabilityFilterPlugin;

class ProductOfferServicePointAvailabilityStorageDependencyProvider extends SprykerProductOfferServicePointAvailabilityStorageDependencyProvider
{
    /**
     * @return list<\Spryker\Client\ProductOfferServicePointAvailabilityStorageExtension\Dependency\Plugin\ProductOfferServicePointAvailabilityFilterPluginInterface>
     */
    protected function getProductOfferServicePointAvailabilityFilterPlugins(): array
    {
        return [
            new ShipmentTypeProductOfferServicePointAvailabilityFilterPlugin(),
        ];
    }
}
