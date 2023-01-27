<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\PersistentCart;

use Spryker\Client\DiscountPromotion\Plugin\AddDiscountPromotionPersistentCartRequestExpanderPlugin;
use Spryker\Client\MultiCart\Plugin\DefaultQuoteUpdatePlugin;
use Spryker\Client\MultiCart\Plugin\PersistentCart\MultiCartQuotePersistPlugin;
use Spryker\Client\MultiCart\Plugin\QuickOrderQuoteNameExpanderPlugin;
use Spryker\Client\MultiCart\Plugin\QuoteSelectorPersistentCartChangeExpanderPlugin;
use Spryker\Client\MultiCart\Plugin\ReorderPersistentCartChangeExpanderPlugin;
use Spryker\Client\MultiCart\Plugin\SaveCustomerQuotesQuoteUpdatePlugin;
use Spryker\Client\PersistentCart\PersistentCartDependencyProvider as SprykerPersistentCartDependencyProvider;
use Spryker\Client\PersistentCartExtension\Dependency\Plugin\QuotePersistPluginInterface;
use Spryker\Client\ProductConfigurationPersistentCart\Plugin\PersistentCart\ProductConfigurationPersistentCartRequestExpanderPlugin;
use Spryker\Client\ProductMeasurementUnit\Plugin\PersistentCart\SingleItemQuantitySalesUnitPersistentCartChangeExpanderPlugin;
use Spryker\Client\ProductPackagingUnit\Plugin\PersistentCartExtension\ProductPackagingUnitAmountPersistentCartChangeExpanderPlugin;
use Spryker\Client\SharedCart\Plugin\PermissionUpdateQuoteUpdatePlugin;
use Spryker\Client\SharedCart\Plugin\ProductSeparatePersistentCartChangeExpanderPlugin;
use Spryker\Client\SharedCart\Plugin\SharedCartsUpdateQuoteUpdatePlugin;

class PersistentCartDependencyProvider extends SprykerPersistentCartDependencyProvider
{
    /**
     * @return array<\Spryker\Client\PersistentCartExtension\Dependency\Plugin\QuoteUpdatePluginInterface>
     */
    protected function getQuoteUpdatePlugins(): array
    {
        return [
            new SaveCustomerQuotesQuoteUpdatePlugin(), #MultiCartFeature
            new SharedCartsUpdateQuoteUpdatePlugin(), #SharedCartFeature
            new DefaultQuoteUpdatePlugin(), #MultiCartFeature
            new PermissionUpdateQuoteUpdatePlugin(), #SharedCartFeature
        ];
    }

    /**
     * @return array<\Spryker\Client\PersistentCartExtension\Dependency\Plugin\PersistentCartChangeExpanderPluginInterface>
     */
    protected function getChangeRequestExtendPlugins(): array
    {
        return [
            new AddDiscountPromotionPersistentCartRequestExpanderPlugin(),
            new QuoteSelectorPersistentCartChangeExpanderPlugin(), #MultiCartFeature
            new QuickOrderQuoteNameExpanderPlugin(), #MultiCartFeature
            new ReorderPersistentCartChangeExpanderPlugin(), #MultiCartFeature
            new ProductSeparatePersistentCartChangeExpanderPlugin(), #SharedCartFeature
            new SingleItemQuantitySalesUnitPersistentCartChangeExpanderPlugin(),
            new ProductPackagingUnitAmountPersistentCartChangeExpanderPlugin(), #ProductPackagingUnit
            new ProductConfigurationPersistentCartRequestExpanderPlugin(),
        ];
    }

    /**
     * @return \Spryker\Client\PersistentCartExtension\Dependency\Plugin\QuotePersistPluginInterface
     */
    protected function getQuotePersistPlugin(): QuotePersistPluginInterface
    {
        return new MultiCartQuotePersistPlugin();
    }
}
