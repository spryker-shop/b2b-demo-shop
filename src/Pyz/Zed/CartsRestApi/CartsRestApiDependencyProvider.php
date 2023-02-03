<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CartsRestApi;

use Spryker\Zed\CartsRestApi\CartsRestApiDependencyProvider as SprykerCartsRestApiDependencyProvider;
use Spryker\Zed\CartsRestApiExtension\Dependency\Plugin\QuoteCreatorPluginInterface;
use Spryker\Zed\CompanyUsersRestApi\Communication\Plugin\CartsRestApi\CustomerCompanyUserQuoteExpanderPlugin;
use Spryker\Zed\DiscountPromotionsRestApi\Communication\Plugin\CartsRestApi\DiscountPromotionCartItemMapperPlugin;
use Spryker\Zed\PersistentCart\Communication\Plugin\CartsRestApi\QuoteCreatorPlugin;
use Spryker\Zed\ProductBundleCartsRestApi\Communication\Plugin\BundleItemQuoteItemReadValidatorPlugin;
use Spryker\Zed\ProductConfigurationsRestApi\Communication\Plugin\CartsRestApi\ProductConfigurationCartItemMapperPlugin;
use Spryker\Zed\ProductMeasurementUnitsRestApi\Communication\Plugin\CartsRestApi\SalesUnitCartItemMapperPlugin;
use Spryker\Zed\ProductOptionsRestApi\Communication\Plugin\CartsRestApi\ProductOptionCartItemMapperPlugin;
use Spryker\Zed\SalesOrderThresholdsRestApi\Communication\Plugin\CartsRestApi\SalesOrderThresholdQuoteExpanderPlugin;
use Spryker\Zed\SharedCart\Communication\Plugin\CartsRestApi\SharedCartQuoteCollectionExpanderPlugin;
use Spryker\Zed\SharedCartsRestApi\Communication\Plugin\CartsRestApi\QuotePermissionGroupQuoteExpanderPlugin;

class CartsRestApiDependencyProvider extends SprykerCartsRestApiDependencyProvider
{
    /**
     * @return \Spryker\Zed\CartsRestApiExtension\Dependency\Plugin\QuoteCreatorPluginInterface
     */
    protected function getQuoteCreatorPlugin(): QuoteCreatorPluginInterface
    {
        return new QuoteCreatorPlugin();
    }

    /**
     * @return array<\Spryker\Zed\CartsRestApiExtension\Dependency\Plugin\QuoteCollectionExpanderPluginInterface>
     */
    protected function getQuoteCollectionExpanderPlugins(): array
    {
        return [
            new SharedCartQuoteCollectionExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\CartsRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface>
     */
    protected function getQuoteExpanderPlugins(): array
    {
        return [
            new QuotePermissionGroupQuoteExpanderPlugin(),
            new CustomerCompanyUserQuoteExpanderPlugin(),
            new SalesOrderThresholdQuoteExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\CartsRestApiExtension\Dependency\Plugin\CartItemMapperPluginInterface>
     */
    protected function getCartItemMapperPlugins(): array
    {
        return [
            new ProductOptionCartItemMapperPlugin(),
            new DiscountPromotionCartItemMapperPlugin(),
            new SalesUnitCartItemMapperPlugin(),
            new ProductConfigurationCartItemMapperPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\CartsRestApiExtension\Dependency\Plugin\QuoteItemReadValidatorPluginInterface>
     */
    protected function getQuoteItemReadValidatorPlugins(): array
    {
        return [
            new BundleItemQuoteItemReadValidatorPlugin(),
        ];
    }
}
