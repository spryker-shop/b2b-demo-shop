<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\ProductConfiguratorGatewayPage;

use Generated\Shared\Transfer\ProductConfiguratorRedirectTransfer;
use Generated\Shared\Transfer\ProductConfiguratorRequestTransfer;
use Generated\Shared\Transfer\ProductConfiguratorResponseProcessorResponseTransfer;
use Generated\Shared\Transfer\ProductConfiguratorResponseTransfer;
use SprykerShop\Yves\ProductConfigurationCartWidget\Plugin\ProductConfiguratorGatewayPage\CartPageProductConfiguratorRequestDataFormExpanderStrategyPlugin;
use SprykerShop\Yves\ProductConfigurationCartWidget\Plugin\ProductConfiguratorGatewayPage\CartPageProductConfiguratorRequestStartegyPlugin;
use SprykerShop\Yves\ProductConfigurationCartWidget\Plugin\ProductConfiguratorGatewayPage\CartPageProductConfiguratorResponseStrategyPlugin;
use SprykerShop\Yves\ProductConfigurationShoppingListWidget\Plugin\ProductConfiguratorGatewayPage\ShoppingListPageProductConfiguratorRequestDataFormExpanderStrategyPlugin;
use SprykerShop\Yves\ProductConfigurationShoppingListWidget\Plugin\ProductConfiguratorGatewayPage\ShoppingListPageProductConfiguratorRequestStrategyPlugin;
use SprykerShop\Yves\ProductConfigurationShoppingListWidget\Plugin\ProductConfiguratorGatewayPage\ShoppingListPageProductConfiguratorResponseStrategyPlugin;
use SprykerShop\Yves\ProductConfiguratorGatewayPage\Plugin\ProductConfiguratorGatewayPage\ProductDetailPageProductConfiguratorRequestDataFormExpanderStrategyPlugin;
use SprykerShop\Yves\ProductConfiguratorGatewayPage\Plugin\ProductConfiguratorGatewayPage\ProductDetailPageProductConfiguratorRequestStrategyPlugin;
use SprykerShop\Yves\ProductConfiguratorGatewayPage\Plugin\ProductConfiguratorGatewayPage\ProductDetailPageProductConfiguratorResponseStrategyPlugin;
use SprykerShop\Yves\ProductConfiguratorGatewayPage\ProductConfiguratorGatewayPageDependencyProvider as SprykerProductConfiguratorGatewayPageDependencyProvider;
use SprykerShop\Yves\ProductConfiguratorGatewayPageExtension\Dependency\Plugin\ProductConfiguratorRequestStrategyPluginInterface;
use SprykerShop\Yves\ProductConfiguratorGatewayPageExtension\Dependency\Plugin\ProductConfiguratorResponseStrategyPluginInterface;

class ProductConfiguratorGatewayPageDependencyProvider extends SprykerProductConfiguratorGatewayPageDependencyProvider
{
    /**
     * @return array<\SprykerShop\Yves\ProductConfiguratorGatewayPageExtension\Dependency\Plugin\ProductConfiguratorRequestStrategyPluginInterface>
     */
    protected function getProductConfiguratorRequestPlugins(): array
    {
        return [
            new class implements ProductConfiguratorRequestStrategyPluginInterface {

                public function isApplicable(ProductConfiguratorRequestTransfer $productConfiguratorRequestTransfer): bool
                {
                    return true;
                }

                public function resolveProductConfiguratorRedirect(ProductConfiguratorRequestTransfer $productConfiguratorRequestTransfer): ProductConfiguratorRedirectTransfer
                {
                    return (new ProductConfiguratorRedirectTransfer())
                        ->setIsSuccessful(true)
                        ->setConfiguratorRedirectUrl(
                            sprintf(
                                'http://yves.eu.b2b.local/%s',
                                'test',
                            )
                        );
                }
            },
            new ProductDetailPageProductConfiguratorRequestStrategyPlugin(),
            new CartPageProductConfiguratorRequestStartegyPlugin(),
            new ShoppingListPageProductConfiguratorRequestStrategyPlugin(),
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\ProductConfiguratorGatewayPageExtension\Dependency\Plugin\ProductConfiguratorResponseStrategyPluginInterface>
     */
    protected function getProductConfiguratorResponsePlugins(): array
    {
        return [
            new class implements ProductConfiguratorResponseStrategyPluginInterface {

                public function isApplicable(ProductConfiguratorResponseTransfer $productConfiguratorResponseTransfer): bool
                {
                    return true;
                }

                public function processProductConfiguratorResponse(ProductConfiguratorResponseTransfer $productConfiguratorResponseTransfer, array $configuratorResponseData): ProductConfiguratorResponseProcessorResponseTransfer
                {
                    return (new ProductConfiguratorResponseProcessorResponseTransfer())
                        ->setIsSuccessful(true)
                        ->setProductConfiguratorResponse(
                            (new ProductConfiguratorResponseTransfer())->fromArray($configuratorResponseData, true),
                        )
                        ->setBackUrl('/DE/en/wolf-garderobe-lichtgrau-ral-7035-M1896');
                }
            },
            new ProductDetailPageProductConfiguratorResponseStrategyPlugin(),
            new CartPageProductConfiguratorResponseStrategyPlugin(),
            new ShoppingListPageProductConfiguratorResponseStrategyPlugin(),
        ];
    }

    /**
     * @return array<\SprykerShop\Yves\ProductConfiguratorGatewayPageExtension\Dependency\Plugin\ProductConfiguratorRequestDataFormExpanderStrategyPluginInterface>
     */
    protected function getProductConfiguratorRequestDataFormExpanderStrategyPlugins(): array
    {
        return [
            new ProductDetailPageProductConfiguratorRequestDataFormExpanderStrategyPlugin(),
            new CartPageProductConfiguratorRequestDataFormExpanderStrategyPlugin(),
            new ShoppingListPageProductConfiguratorRequestDataFormExpanderStrategyPlugin(),
        ];
    }
}
