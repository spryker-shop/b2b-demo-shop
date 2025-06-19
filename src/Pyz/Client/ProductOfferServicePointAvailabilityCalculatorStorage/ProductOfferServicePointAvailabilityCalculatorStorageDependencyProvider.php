<?php

namespace Pyz\Client\ProductOfferServicePointAvailabilityCalculatorStorage;

use Spryker\Client\ClickAndCollectExample\Plugin\ExampleClickAndCollectProductOfferServicePointAvailabilityCalculatorStrategyPlugin;
use Spryker\Client\ProductOfferServicePointAvailabilityCalculatorStorage\ProductOfferServicePointAvailabilityCalculatorStorageDependencyProvider as SprykerProductOfferServicePointAvailabilityCalculatorStorageDependencyProvider;

class ProductOfferServicePointAvailabilityCalculatorStorageDependencyProvider extends SprykerProductOfferServicePointAvailabilityCalculatorStorageDependencyProvider
{
    protected function getProductOfferServicePointAvailabilityCalculatorStrategyPlugins(): array
    {
        return [
            new ExampleClickAndCollectProductOfferServicePointAvailabilityCalculatorStrategyPlugin(),
        ];
    }
}
