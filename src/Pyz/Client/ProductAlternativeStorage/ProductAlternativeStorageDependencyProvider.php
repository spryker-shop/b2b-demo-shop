<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Client\ProductAlternativeStorage;

use Spryker\Client\AvailabilityStorage\Plugin\ProductAlternativeStorage\AvailabilityCheckAlternativeProductApplicablePlugin;
use Spryker\Client\ProductAlternativeStorage\ProductAlternativeStorageDependencyProvider as SprykerProductAlternativeStorageDependencyProvider;
use Spryker\Client\ProductDiscontinuedStorage\Plugin\ProductAlternativeStorage\DiscontinuedCheckAlternativeProductApplicablePlugin;

class ProductAlternativeStorageDependencyProvider extends SprykerProductAlternativeStorageDependencyProvider
{
    /**
     * @return array<\Spryker\Client\ProductAlternativeStorageExtension\Dependency\Plugin\AlternativeProductApplicablePluginInterface>
     */
    protected function getAlternativeProductApplicableCheckPlugins(): array
    {
        return [
            new DiscontinuedCheckAlternativeProductApplicablePlugin(), #ProductDiscontinuedFeature
            new AvailabilityCheckAlternativeProductApplicablePlugin(),
        ];
    }
}
