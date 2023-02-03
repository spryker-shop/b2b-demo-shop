<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\ShoppingListSession;

use Spryker\Client\ShoppingListSession\ShoppingListSessionDependencyProvider as SprykerShoppingListSessionDependencyProvider;
use Spryker\Client\ShoppingListStorage\Dependency\Plugin\ShoppingListSession\ShoppingListCollectionOutdatedPlugin;

class ShoppingListSessionDependencyProvider extends SprykerShoppingListSessionDependencyProvider
{
    /**
     * @return array<\Spryker\Client\ShoppingListSessionExtension\Dependency\Plugin\ShoppingListCollectionOutdatedPluginInterface>
     */
    protected function getShoppingListCollectionOutdatedPlugins(): array
    {
        return [
            new ShoppingListCollectionOutdatedPlugin(),
        ];
    }
}
