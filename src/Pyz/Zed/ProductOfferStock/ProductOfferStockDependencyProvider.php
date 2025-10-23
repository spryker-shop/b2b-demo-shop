<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ProductOfferStock;

use Spryker\Zed\ProductOfferStock\ProductOfferStockDependencyProvider as SprykerProductOfferStockDependencyProvider;
use Spryker\Zed\StockAddress\Communication\Plugin\Stock\StockAddressStockTransferProductOfferStockExpanderPlugin;

class ProductOfferStockDependencyProvider extends SprykerProductOfferStockDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\ProductOfferStockExtension\Dependency\Plugin\StockTransferProductOfferStockExpanderPluginInterface>
     */
    protected function getStockTransferExpanderPluginCollection(): array
    {
        return [
            new StockAddressStockTransferProductOfferStockExpanderPlugin(),
        ];
    }
}
