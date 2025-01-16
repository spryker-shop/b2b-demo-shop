<?php



declare(strict_types = 1);

namespace Pyz\Zed\ProductDiscountConnector;

use Spryker\Zed\ProductBundleDiscountConnector\Communication\Plugin\ProductDiscountConnector\ProductBundleProductAttributeCollectorExpanderPlugin;
use Spryker\Zed\ProductBundleDiscountConnector\Communication\Plugin\ProductDiscountConnector\ProductBundleProductAttributeDecisionRuleExpanderPlugin;
use Spryker\Zed\ProductDiscountConnector\ProductDiscountConnectorDependencyProvider as SprykerProductDiscountConnectorDependencyProvider;

class ProductDiscountConnectorDependencyProvider extends SprykerProductDiscountConnectorDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\ProductDiscountConnectorExtension\Dependency\Plugin\ProductAttributeCollectorExpanderPluginInterface>
     */
    protected function getProductAttributeCollectorExpanderPlugins(): array
    {
        return [
            new ProductBundleProductAttributeCollectorExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductDiscountConnectorExtension\Dependency\Plugin\ProductAttributeDecisionRuleExpanderPluginInterface>
     */
    protected function getProductAttributeDecisionRuleExpanderPlugins(): array
    {
        return [
            new ProductBundleProductAttributeDecisionRuleExpanderPlugin(),
        ];
    }
}
