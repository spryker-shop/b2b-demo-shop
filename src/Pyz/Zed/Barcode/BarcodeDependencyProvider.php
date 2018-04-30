<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Barcode;

use Spryker\Service\Barcode\BarcodeDependencyProvider as SprykerDependencyProvider;

class BarcodeDependencyProvider extends SprykerDependencyProvider
{
    /**
     * @return array
     */
    protected function getBarcodePlugins(): array
    {
        return [];
    }
}
