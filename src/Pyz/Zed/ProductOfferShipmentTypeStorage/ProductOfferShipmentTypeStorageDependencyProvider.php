<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

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
