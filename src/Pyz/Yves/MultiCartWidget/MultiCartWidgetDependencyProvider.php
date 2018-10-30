<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\MultiCartWidget;

use SprykerShop\Yves\MultiCartWidget\MultiCartWidgetDependencyProvider as SprykerMultiCartWidgetDependencyProvider;

class MultiCartWidgetDependencyProvider extends SprykerMultiCartWidgetDependencyProvider
{
    /**
     * @return array
     */
    protected function getViewExtendWidgetPlugins(): array
    {
        return [];
    }
}
