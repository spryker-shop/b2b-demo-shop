<?php



declare(strict_types = 1);

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
