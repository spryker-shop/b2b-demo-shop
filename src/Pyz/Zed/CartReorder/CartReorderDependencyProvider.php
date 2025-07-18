<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\CartReorder;

use Spryker\Zed\AvailabilityCartConnector\Communication\Plugin\CartReorder\RemoveUnavailableItemsCartReorderPreAddToCartPlugin;
use Spryker\Zed\CartNote\Communication\Plugin\CartReorder\CartNoteCartPreReorderPlugin;
use Spryker\Zed\CartNote\Communication\Plugin\CartReorder\CartNoteCartReorderItemHydratorPlugin;
use Spryker\Zed\CartReorder\CartReorderDependencyProvider as SprykerCartReorderDependencyProvider;
use Spryker\Zed\Comment\Communication\Plugin\CartReorder\CopyOrderCommentThreadCartPreReorderPlugin;
use Spryker\Zed\ConfigurableBundleNote\Communication\Plugin\CartReorder\ConfigurableBundleNoteCartReorderItemHydratorPlugin;
use Spryker\Zed\Currency\Communication\Plugin\CartReorder\CopyOrderCurrencyCartPreReorderPlugin;
use Spryker\Zed\MultiCart\Communication\Plugin\CartReorder\DefaultReorderQuoteNameCartPreReorderPlugin;
use Spryker\Zed\MultiCart\Communication\Plugin\CartReorder\NewPersistentCartReorderQuoteProviderStrategyPlugin;
use Spryker\Zed\OrderCustomReference\Communication\Plugin\CartReorder\OrderCustomReferenceCartPreReorderPlugin;
use Spryker\Zed\PersistentCart\Communication\Plugin\CartReorder\ReplacePersistentCartReorderQuoteProviderStrategyPlugin;
use Spryker\Zed\PersistentCart\Communication\Plugin\CartReorder\UpdateQuoteCartPostReorderPlugin;
use Spryker\Zed\Price\Communication\Plugin\CartReorder\CopyOrderPriceModeCartPreReorderPlugin;
use Spryker\Zed\PriceProductSalesOrderAmendment\Communication\Plugin\CartReorder\OriginalSalesOrderItemPriceCartPreReorderPlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\CartReorder\OriginalOrderBundleItemCartPreReorderPlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\CartReorder\ProductBundleCartReorderOrderItemFilterPlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\CartReorder\ReplaceBundledItemsCartPreReorderPlugin;
use Spryker\Zed\ProductCartConnector\Communication\Plugin\CartReorder\RemoveInactiveItemsCartReorderPreAddToCartPlugin;
use Spryker\Zed\ProductList\Communication\Plugin\CartReorder\ProductListRestrictedItemsCartPreReorderPlugin;
use Spryker\Zed\ProductMeasurementUnit\Communication\Plugin\CartReorder\MergeProductMeasurementUnitItemsCartPreReorderPlugin;
use Spryker\Zed\ProductMeasurementUnit\Communication\Plugin\CartReorder\ProductMeasurementUnitCartReorderItemHydratorPlugin;
use Spryker\Zed\ProductOption\Communication\Plugin\CartReorder\ProductOptionCartReorderItemHydratorPlugin;
use Spryker\Zed\ProductOptionCartConnector\Communication\Plugin\CartReorder\RemoveInactiveProductOptionItemsCartReorderPreAddToCartPlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\CartReorder\MergeProductPackagingUnitItemsCartPreReorderPlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\CartReorder\ProductPackagingUnitCartReorderItemHydratorPlugin;
use Spryker\Zed\ProductQuantity\Communication\Plugin\CartReorder\MergeProductQuantityRestrictionItemsCartPreReorderPlugin;
use Spryker\Zed\SalesConfigurableBundle\Communication\Plugin\CartReorder\ConfigurableBundleCartReorderItemHydratorPlugin;
use Spryker\Zed\SalesConfigurableBundle\Communication\Plugin\CartReorder\ConfiguredBundleCartPostReorderPlugin;
use Spryker\Zed\SalesConfigurableBundle\Communication\Plugin\CartReorder\MergeConfigurableBundleItemsCartPreReorderPlugin;
use Spryker\Zed\SalesOrderAmendment\Communication\Plugin\CartReorder\AmendmentOrderReferenceCartPreReorderPlugin;
use Spryker\Zed\SalesOrderAmendment\Communication\Plugin\CartReorder\AmendmentQuoteNameCartPreReorderPlugin;
use Spryker\Zed\SalesOrderAmendment\Communication\Plugin\CartReorder\OrderAmendmentCartReorderValidatorPlugin;
use Spryker\Zed\SalesOrderAmendment\Communication\Plugin\CartReorder\OrderAmendmentQuoteProcessFlowExpanderCartPreReorderPlugin;
use Spryker\Zed\SalesOrderAmendment\Communication\Plugin\CartReorder\OriginalSalesOrderItemCartPreReorderPlugin;
use Spryker\Zed\SalesOrderAmendment\Communication\Plugin\CartReorder\OriginalSalesOrderItemGroupKeyCartReorderItemHydratorPlugin;
use Spryker\Zed\SalesOrderAmendment\Communication\Plugin\CartReorder\QuoteRequestVersionCartReorderValidatorPlugin;
use Spryker\Zed\SalesOrderAmendmentOms\Communication\Plugin\CartReorder\IsAmendableOrderCartReorderRequestValidatorPlugin;
use Spryker\Zed\SalesOrderAmendmentOms\Communication\Plugin\CartReorder\StartOrderAmendmentCartReorderPostCreatePlugin;
use Spryker\Zed\SalesProductConfiguration\Communication\Plugin\CartReorder\ProductConfigurationCartReorderItemHydratorPlugin;
use Spryker\Zed\Store\Communication\Plugin\CartReorder\CurrentStoreCartReorderValidatorPlugin;

class CartReorderDependencyProvider extends SprykerCartReorderDependencyProvider
{
    /**
     * @return list<\Spryker\Zed\CartReorderExtension\Dependency\Plugin\CartReorderValidatorPluginInterface>
     */
    protected function getCartReorderValidatorPlugins(): array
    {
        return [
            new CurrentStoreCartReorderValidatorPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\CartReorderExtension\Dependency\Plugin\CartReorderRequestValidatorPluginInterface>
     */
    protected function getCartReorderRequestValidatorPlugins(): array
    {
        return [
            new IsAmendableOrderCartReorderRequestValidatorPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\CartReorderExtension\Dependency\Plugin\CartReorderQuoteProviderStrategyPluginInterface>
     */
    protected function getCartReorderQuoteProviderStrategyPlugins(): array
    {
        return [
            new ReplacePersistentCartReorderQuoteProviderStrategyPlugin(),
            new NewPersistentCartReorderQuoteProviderStrategyPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\CartReorderExtension\Dependency\Plugin\CartReorderValidatorPluginInterface>
     */
    protected function getCartReorderValidatorPluginsForOrderAmendment(): array
    {
        return [
            new CurrentStoreCartReorderValidatorPlugin(),
            new OrderAmendmentCartReorderValidatorPlugin(),
            new QuoteRequestVersionCartReorderValidatorPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\CartReorderExtension\Dependency\Plugin\CartPreReorderPluginInterface>
     */
    protected function getCartPreReorderPlugins(): array
    {
        return [
            new CopyOrderCurrencyCartPreReorderPlugin(),
            new CopyOrderPriceModeCartPreReorderPlugin(),
            new ProductListRestrictedItemsCartPreReorderPlugin(),
            new DefaultReorderQuoteNameCartPreReorderPlugin(),
            new ReplaceBundledItemsCartPreReorderPlugin(),
            new MergeProductMeasurementUnitItemsCartPreReorderPlugin(),
            new MergeProductPackagingUnitItemsCartPreReorderPlugin(),
            new MergeConfigurableBundleItemsCartPreReorderPlugin(),
            new CartNoteCartPreReorderPlugin(),
            new OrderCustomReferenceCartPreReorderPlugin(),
            new MergeProductQuantityRestrictionItemsCartPreReorderPlugin(),
            new CopyOrderCommentThreadCartPreReorderPlugin(),
            new OrderAmendmentQuoteProcessFlowExpanderCartPreReorderPlugin(), #Order Amendment Feature
            new AmendmentOrderReferenceCartPreReorderPlugin(), #Order Amendment Feature
            new AmendmentQuoteNameCartPreReorderPlugin(), #Order Amendment Feature
            new OriginalSalesOrderItemPriceCartPreReorderPlugin(), #Order Amendment Feature
            new OriginalSalesOrderItemCartPreReorderPlugin(), #Order Amendment Feature
            new OriginalOrderBundleItemCartPreReorderPlugin(), #Order Amendment Feature
        ];
    }

    /**
     * @return list<\Spryker\Zed\CartReorderExtension\Dependency\Plugin\CartReorderItemHydratorPluginInterface>
     */
    protected function getCartReorderItemHydratorPlugins(): array
    {
        return [
            new ProductMeasurementUnitCartReorderItemHydratorPlugin(),
            new ProductPackagingUnitCartReorderItemHydratorPlugin(),
            new CartNoteCartReorderItemHydratorPlugin(),
            new ProductConfigurationCartReorderItemHydratorPlugin(),
            new ProductOptionCartReorderItemHydratorPlugin(),
            new ConfigurableBundleCartReorderItemHydratorPlugin(),
            new ConfigurableBundleNoteCartReorderItemHydratorPlugin(),
            new OriginalSalesOrderItemGroupKeyCartReorderItemHydratorPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\CartReorderExtension\Dependency\Plugin\CartPostReorderPluginInterface>
     */
    protected function getCartPostReorderPlugins(): array
    {
        return [
            new UpdateQuoteCartPostReorderPlugin(),
            new ConfiguredBundleCartPostReorderPlugin(),
            new StartOrderAmendmentCartReorderPostCreatePlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\CartReorderExtension\Dependency\Plugin\CartReorderPreAddToCartPluginInterface>
     */
    protected function getCartReorderPreAddToCartPlugins(): array
    {
        return [
            new RemoveUnavailableItemsCartReorderPreAddToCartPlugin(),
            new RemoveInactiveItemsCartReorderPreAddToCartPlugin(),
            new RemoveInactiveProductOptionItemsCartReorderPreAddToCartPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\CartReorderExtension\Dependency\Plugin\CartReorderPreAddToCartPluginInterface>
     */
    protected function getCartReorderPreAddToCartPluginsForOrderAmendment(): array
    {
        return [
            new RemoveInactiveProductOptionItemsCartReorderPreAddToCartPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\CartReorderExtension\Dependency\Plugin\CartReorderOrderItemFilterPluginInterface>
     */
    protected function getCartReorderOrderItemFilterPlugins(): array
    {
        return [
            new ProductBundleCartReorderOrderItemFilterPlugin(),
        ];
    }
}
