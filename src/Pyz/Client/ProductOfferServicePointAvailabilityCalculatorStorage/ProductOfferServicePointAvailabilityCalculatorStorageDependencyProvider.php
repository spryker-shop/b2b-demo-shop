<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Client\ProductOfferServicePointAvailabilityCalculatorStorage;

use Spryker\Client\ClickAndCollectExample\Plugin\ExampleClickAndCollectProductOfferServicePointAvailabilityCalculatorStrategyPlugin;
use Spryker\Client\ProductOfferServicePointAvailabilityCalculatorStorage\ProductOfferServicePointAvailabilityCalculatorStorageDependencyProvider as SprykerProductOfferServicePointAvailabilityCalculatorStorageDependencyProvider;

class ProductOfferServicePointAvailabilityCalculatorStorageDependencyProvider extends SprykerProductOfferServicePointAvailabilityCalculatorStorageDependencyProvider
{
    /**
     * @return list<\Spryker\Client\ProductOfferServicePointAvailabilityCalculatorStorageExtension\Dependency\Plugin\ProductOfferServicePointAvailabilityCalculatorStrategyPluginInterface>
     */
    protected function getProductOfferServicePointAvailabilityCalculatorStrategyPlugins(): array
    {
        return [
            new ExampleClickAndCollectProductOfferServicePointAvailabilityCalculatorStrategyPlugin(),
        ];
    }
}
