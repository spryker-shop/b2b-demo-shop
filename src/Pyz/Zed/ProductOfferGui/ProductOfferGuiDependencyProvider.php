<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ProductOfferGui;

use Spryker\Zed\MerchantGui\Communication\Plugin\ProductOffer\MerchantProductOfferListActionViewDataExpanderPlugin;
use Spryker\Zed\MerchantProductOfferGui\Communication\Plugin\MerchantProductOfferTableExpanderPlugin;
use Spryker\Zed\MerchantProductOfferGui\Communication\Plugin\ProductOfferGui\MerchantProductOfferViewSectionPlugin;
use Spryker\Zed\PriceProductOfferGui\Communication\Plugin\ProductOfferGui\PriceProductOfferProductOfferViewSectionPlugin;
use Spryker\Zed\ProductOfferGui\ProductOfferGuiDependencyProvider as SprykerProductOfferGuiDependencyProvider;
use Spryker\Zed\ProductOfferServicePointGui\Communication\Plugin\ProductOfferGui\ServiceProductOfferViewSectionPlugin;
use Spryker\Zed\ProductOfferShipmentTypeGui\Communication\Plugin\ProductOfferGui\ShipmentTypeProductOfferViewSectionPlugin;
use Spryker\Zed\ProductOfferStockGui\Communication\Plugin\ProductOffer\ProductOfferStockProductOfferViewSectionPlugin;
use Spryker\Zed\ProductOfferValidityGui\Communication\Plugin\ProductOfferGui\ProductOfferValidityProductOfferViewSectionPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\ProductOfferGui\EditOfferProductOfferTableActionPlugin;

class ProductOfferGuiDependencyProvider extends SprykerProductOfferGuiDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\ProductOfferGuiExtension\Dependency\Plugin\ProductOfferListActionViewDataExpanderPluginInterface>
     */
    protected function getProductOfferListActionViewDataExpanderPlugins(): array
    {
        return [
            new MerchantProductOfferListActionViewDataExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductOfferGuiExtension\Dependency\Plugin\ProductOfferTableExpanderPluginInterface>
     */
    protected function getProductOfferTableExpanderPlugins(): array
    {
        return [
            new MerchantProductOfferTableExpanderPlugin(),
            new EditOfferProductOfferTableActionPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductOfferGuiExtension\Dependency\Plugin\ProductOfferViewSectionPluginInterface>
     */
    public function getProductOfferViewSectionPlugins(): array
    {
        return [
            new MerchantProductOfferViewSectionPlugin(),
            new ProductOfferValidityProductOfferViewSectionPlugin(),
            new PriceProductOfferProductOfferViewSectionPlugin(),
            new ProductOfferStockProductOfferViewSectionPlugin(),
            new ServiceProductOfferViewSectionPlugin(),
            new ShipmentTypeProductOfferViewSectionPlugin(),
        ];
    }
}
