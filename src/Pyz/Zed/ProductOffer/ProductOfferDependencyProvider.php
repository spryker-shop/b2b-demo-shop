<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ProductOffer;

use Spryker\Zed\PriceProductOffer\Communication\Plugin\ProductOffer\PriceProductOfferProductOfferExpanderPlugin;
use Spryker\Zed\PriceProductOffer\Communication\Plugin\ProductOffer\PriceProductOfferProductOfferPostCreatePlugin;
use Spryker\Zed\PriceProductOffer\Communication\Plugin\ProductOffer\PriceProductOfferProductOfferPostUpdatePlugin;
use Spryker\Zed\ProductOffer\ProductOfferDependencyProvider as SprykerProductOfferDependencyProvider;
use Spryker\Zed\ProductOfferServicePoint\Communication\Plugin\ProductOffer\ServiceProductOfferExpanderPlugin;
use Spryker\Zed\ProductOfferServicePoint\Communication\Plugin\ProductOffer\ServiceProductOfferPostCreatePlugin;
use Spryker\Zed\ProductOfferServicePoint\Communication\Plugin\ProductOffer\ServiceProductOfferPostUpdatePlugin;
use Spryker\Zed\ProductOfferShipmentType\Communication\Plugin\ProductOffer\ShipmentTypeProductOfferExpanderPlugin;
use Spryker\Zed\ProductOfferShipmentType\Communication\Plugin\ProductOffer\ShipmentTypeProductOfferPostCreatePlugin;
use Spryker\Zed\ProductOfferShipmentType\Communication\Plugin\ProductOffer\ShipmentTypeProductOfferPostUpdatePlugin;
use Spryker\Zed\ProductOfferStock\Communication\Plugin\ProductOffer\ProductOfferStockProductOfferExpanderPlugin;
use Spryker\Zed\ProductOfferStock\Communication\Plugin\ProductOffer\ProductOfferStockProductOfferPostCreatePlugin;
use Spryker\Zed\ProductOfferStock\Communication\Plugin\ProductOffer\ProductOfferStockProductOfferPostUpdatePlugin;
use Spryker\Zed\ProductOfferValidity\Communication\Plugin\ProductOffer\ProductOfferValidityProductOfferExpanderPlugin;
use Spryker\Zed\ProductOfferValidity\Communication\Plugin\ProductOffer\ProductOfferValidityProductOfferPostCreatePlugin;
use Spryker\Zed\ProductOfferValidity\Communication\Plugin\ProductOffer\ProductOfferValidityProductOfferPostUpdatePlugin;

class ProductOfferDependencyProvider extends SprykerProductOfferDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\ProductOfferExtension\Dependency\Plugin\ProductOfferPostCreatePluginInterface>
     */
    protected function getProductOfferPostCreatePlugins(): array
    {
        return [
            new ProductOfferValidityProductOfferPostCreatePlugin(),
            new PriceProductOfferProductOfferPostCreatePlugin(),
            new ProductOfferStockProductOfferPostCreatePlugin(),
            new ShipmentTypeProductOfferPostCreatePlugin(),
            new ServiceProductOfferPostCreatePlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductOfferExtension\Dependency\Plugin\ProductOfferPostUpdatePluginInterface>
     */
    protected function getProductOfferPostUpdatePlugins(): array
    {
        return [
            new ProductOfferValidityProductOfferPostUpdatePlugin(),
            new PriceProductOfferProductOfferPostUpdatePlugin(),
            new ProductOfferStockProductOfferPostUpdatePlugin(),
            new ShipmentTypeProductOfferPostUpdatePlugin(),
            new ServiceProductOfferPostUpdatePlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductOfferExtension\Dependency\Plugin\ProductOfferExpanderPluginInterface>
     */
    protected function getProductOfferExpanderPlugins(): array
    {
        return [
            new ProductOfferValidityProductOfferExpanderPlugin(),
            new PriceProductOfferProductOfferExpanderPlugin(),
            new ProductOfferStockProductOfferExpanderPlugin(),
            new ShipmentTypeProductOfferExpanderPlugin(),
            new ServiceProductOfferExpanderPlugin(),
        ];
    }
}
