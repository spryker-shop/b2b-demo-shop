<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\MultiCartPage;

use SprykerShop\Yves\MultiCartPage\MultiCartPageDependencyProvider as SprykerShopMultiCartPageDependencyProvider;

class MultiCartPageDependencyProvider extends SprykerShopMultiCartPageDependencyProvider
{
    /**
     * @return string[]
     */
    protected function getCartDeleteCompanyUsersListWidgetPlugins(): array
    {
        return [];
    }

    /**
     * @return string[]
     */
    protected function getMultiCartListWidgetPlugins(): array
    {
        return [];
    }
}
