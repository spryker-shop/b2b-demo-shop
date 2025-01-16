<?php



declare(strict_types = 1);

namespace Pyz\Zed\ProductOption;

use Spryker\Zed\Kernel\Communication\Form\FormTypeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\MoneyGui\Communication\Plugin\Form\MoneyCollectionFormTypePlugin;
use Spryker\Zed\ProductOption\ProductOptionDependencyProvider as SprykerProductOptionDependencyProvider;
use Spryker\Zed\ShoppingListProductOptionConnector\Communication\Plugin\ProductOption\ShoppingListItemsProductOptionValuesPreRemovePlugin;

class ProductOptionDependencyProvider extends SprykerProductOptionDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Communication\Form\FormTypeInterface
     */
    protected function createMoneyCollectionFormTypePlugin(Container $container): FormTypeInterface // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        return new MoneyCollectionFormTypePlugin();
    }

    /**
     * @return array<\Spryker\Zed\ProductOptionExtension\Dependency\Plugin\ProductOptionValuesPreRemovePluginInterface>
     */
    protected function getProductOptionValuesPreRemovePlugins(): array
    {
        return [
            new ShoppingListItemsProductOptionValuesPreRemovePlugin(),
        ];
    }
}
