<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\Sales;

use Spryker\Zed\Agent\Communication\Plugin\Sales\AgentOrderExpanderPreSavePlugin;
use Spryker\Zed\CommentSalesConnector\Communication\Plugin\Sales\CommentThreadAttachedCommentOrderPostSavePlugin;
use Spryker\Zed\CommentSalesConnector\Communication\Plugin\Sales\CommentThreadOrderExpanderPlugin;
use Spryker\Zed\CommentSalesConnector\Communication\Plugin\Sales\SaveOrderCommentThreadOrderPostSavePlugin;
use Spryker\Zed\CompanyBusinessUnitSalesConnector\Communication\Plugin\Sales\CompanyBusinessUnitCustomerFilterOrderSearchQueryExpanderPlugin;
use Spryker\Zed\CompanyBusinessUnitSalesConnector\Communication\Plugin\Sales\CompanyBusinessUnitCustomerOrderAccessCheckPlugin;
use Spryker\Zed\CompanyBusinessUnitSalesConnector\Communication\Plugin\Sales\CompanyBusinessUnitCustomerSortingOrderSearchQueryExpanderPlugin;
use Spryker\Zed\CompanyBusinessUnitSalesConnector\Communication\Plugin\Sales\CompanyBusinessUnitFilterOrderSearchQueryExpanderPlugin;
use Spryker\Zed\CompanyBusinessUnitSalesConnector\Communication\Plugin\Sales\SaveCompanyBusinessUnitUuidOrderPostSavePlugin;
use Spryker\Zed\CompanySalesConnector\Communication\Plugin\Sales\CompanyCustomerFilterOrderSearchQueryExpanderPlugin;
use Spryker\Zed\CompanySalesConnector\Communication\Plugin\Sales\CompanyCustomerOrderAccessCheckPlugin;
use Spryker\Zed\CompanySalesConnector\Communication\Plugin\Sales\CompanyCustomerSortingOrderSearchQueryExpanderPlugin;
use Spryker\Zed\CompanySalesConnector\Communication\Plugin\Sales\CompanyFilterOrderSearchQueryExpanderPlugin;
use Spryker\Zed\CompanySalesConnector\Communication\Plugin\Sales\SaveCompanyUuidOrderPostSavePlugin;
use Spryker\Zed\Currency\Communication\Plugin\Sales\CurrencyOrderExpanderPlugin;
use Spryker\Zed\Customer\Communication\Plugin\Sales\CustomerOrderHydratePlugin;
use Spryker\Zed\Discount\Communication\Plugin\Sales\DiscountOrderHydratePlugin;
use Spryker\Zed\Discount\Communication\Plugin\Sales\DiscountSalesOrderItemCollectionPreDeletePlugin;
use Spryker\Zed\Discount\Communication\Plugin\Sales\SalesDiscountSalesExpensePreDeletePlugin;
use Spryker\Zed\Nopayment\Communication\Plugin\Sales\NopaymentSalesOrderItemCollectionPreDeletePlugin;
use Spryker\Zed\Oms\Communication\Plugin\Sales\DefaultOrderItemInitialStateProviderPlugin;
use Spryker\Zed\Oms\Communication\Plugin\Sales\IsCancellableOrderExpanderPlugin;
use Spryker\Zed\Oms\Communication\Plugin\Sales\IsCancellableSearchOrderExpanderPlugin;
use Spryker\Zed\Oms\Communication\Plugin\Sales\ItemStateOrderItemExpanderPlugin;
use Spryker\Zed\Oms\Communication\Plugin\Sales\OmsItemHistorySalesOrderItemCollectionPreDeletePlugin;
use Spryker\Zed\Oms\Communication\Plugin\Sales\OmsStatesOrderExpanderPlugin;
use Spryker\Zed\Oms\Communication\Plugin\Sales\OrderAggregatedItemStateSearchOrderExpanderPlugin;
use Spryker\Zed\Oms\Communication\Plugin\Sales\StateHistoryOrderItemExpanderPlugin;
use Spryker\Zed\OmsMultiThread\Communication\Plugin\Sales\OmsMultiThreadProcessorIdentifierOrderExpanderPreSavePlugin;
use Spryker\Zed\OrderCustomReference\Communication\Plugin\Sales\OrderCustomReferenceOrderPostSavePlugin;
use Spryker\Zed\OrderCustomReference\Communication\Plugin\Sales\UpdateOrderCustomReferenceOrderPostSavePlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\Sales\ProductBundleIdHydratorPlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\Sales\ProductBundleOptionItemExpanderPlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\Sales\ProductBundleOptionOrderExpanderPlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\Sales\ProductBundleOrderHydratePlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\Sales\ProductBundleOrderItemExpanderPlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\Sales\UniqueOrderBundleItemsExpanderPlugin;
use Spryker\Zed\ProductMeasurementUnit\Communication\Plugin\Sales\QuantitySalesUnitOrderItemExpanderPlugin;
use Spryker\Zed\ProductMeasurementUnit\Communication\Plugin\SalesExtension\QuantitySalesUnitOrderItemExpanderPreSavePlugin;
use Spryker\Zed\ProductOption\Communication\Plugin\Sales\ProductOptionGroupIdHydratorPlugin;
use Spryker\Zed\ProductOption\Communication\Plugin\Sales\ProductOptionOrderItemsPostSavePlugin;
use Spryker\Zed\ProductOption\Communication\Plugin\Sales\ProductOptionSalesOrderItemCollectionPostUpdatePlugin;
use Spryker\Zed\ProductOption\Communication\Plugin\Sales\ProductOptionSalesOrderItemCollectionPreDeletePlugin;
use Spryker\Zed\ProductOption\Communication\Plugin\Sales\ProductOptionsOrderItemExpanderPlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\Checkout\PackagingUnitSplittableItemTransformerStrategyPlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\Sales\AmountLeadProductOrderItemExpanderPlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\Sales\AmountSalesUnitOrderItemExpanderPlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\SalesExtension\AmountSalesUnitOrderItemExpanderPreSavePlugin;
use Spryker\Zed\ProductPackagingUnit\Communication\Plugin\SalesExtension\ProductPackagingUnitOrderItemExpanderPreSavePlugin;
use Spryker\Zed\Sales\Communication\Plugin\Sales\CurrencyIsoCodeOrderItemExpanderPlugin;
use Spryker\Zed\Sales\SalesDependencyProvider as SprykerSalesDependencyProvider;
use Spryker\Zed\SalesConfigurableBundle\Communication\Plugin\Sales\ConfiguredBundleItemPreTransformerPlugin;
use Spryker\Zed\SalesConfigurableBundle\Communication\Plugin\Sales\ConfiguredBundleOrderItemExpanderPlugin;
use Spryker\Zed\SalesConfigurableBundle\Communication\Plugin\Sales\ConfiguredBundlesOrderItemsPostSavePlugin;
use Spryker\Zed\SalesConfigurableBundle\Communication\Plugin\Sales\SalesConfigurableBundleSalesOrderItemCollectionPreDeletePlugin;
use Spryker\Zed\SalesConfigurableBundle\Communication\Plugin\Sales\SalesConfiguredBundlesSalesOrderItemCollectionPostUpdatePlugin;
use Spryker\Zed\SalesOms\Communication\Plugin\OrderItemReferenceExpanderPreSavePlugin;
use Spryker\Zed\SalesOrderAmendment\Communication\Plugin\Sales\CreateSalesOrderAmendmentOrderPostSavePlugin;
use Spryker\Zed\SalesOrderAmendment\Communication\Plugin\Sales\SalesOrderAmendmentOrderExpanderPlugin;
use Spryker\Zed\SalesOrderAmendmentOms\Communication\Plugin\Sales\IsAmendableOrderExpanderPlugin;
use Spryker\Zed\SalesOrderAmendmentOms\Communication\Plugin\Sales\IsAmendableOrderSearchOrderExpanderPlugin;
use Spryker\Zed\SalesOrderAmendmentOms\Communication\Plugin\Sales\OrderAmendmentDefaultOrderItemInitialStateProviderPlugin;
use Spryker\Zed\SalesPayment\Communication\Plugin\Sales\SalesPaymentOrderExpanderPlugin;
use Spryker\Zed\SalesProductConfiguration\Communication\Plugin\Sales\ProductConfigurationOrderItemExpanderPlugin;
use Spryker\Zed\SalesProductConfiguration\Communication\Plugin\Sales\ProductConfigurationOrderItemsPostSavePlugin;
use Spryker\Zed\SalesProductConfiguration\Communication\Plugin\Sales\SalesProductConfigurationSalesOrderItemCollectionPostUpdatePlugin;
use Spryker\Zed\SalesProductConfiguration\Communication\Plugin\Sales\SalesProductConfigurationSalesOrderItemCollectionPreDeletePlugin;
use Spryker\Zed\SalesProductConnector\Communication\Plugin\Sales\ItemMetadataOrderItemsPostSavePlugin;
use Spryker\Zed\SalesProductConnector\Communication\Plugin\Sales\ItemMetadataSalesOrderItemCollectionPostUpdatePlugin;
use Spryker\Zed\SalesProductConnector\Communication\Plugin\Sales\ItemMetadataSalesOrderItemCollectionPreDeletePlugin;
use Spryker\Zed\SalesProductConnector\Communication\Plugin\Sales\ItemMetadataSearchOrderExpanderPlugin;
use Spryker\Zed\SalesProductConnector\Communication\Plugin\Sales\MetadataOrderItemExpanderPlugin;
use Spryker\Zed\SalesProductConnector\Communication\Plugin\Sales\ProductIdOrderItemExpanderPlugin;
use Spryker\Zed\SalesQuantity\Communication\Plugin\SalesExtension\IsQuantitySplittableOrderItemExpanderPreSavePlugin;
use Spryker\Zed\SalesQuantity\Communication\Plugin\SalesExtension\NonSplittableItemTransformerStrategyPlugin;
use Spryker\Zed\SalesQuoteRequestConnector\Communication\Plugin\Sales\QuoteRequestVersionReferenceOrderPostSavePlugin;
use Spryker\Zed\SalesReclamation\Communication\Plugin\Sales\SalesReclamationSalesOrderItemCollectionPreDeletePlugin;
use Spryker\Zed\SalesReclamationGui\Communication\Plugin\Sales\ReclamationSalesTablePlugin;
use Spryker\Zed\SalesReturn\Communication\Plugin\Sales\RemunerationTotalOrderExpanderPlugin;
use Spryker\Zed\SalesReturn\Communication\Plugin\Sales\UpdateOrderItemIsReturnableByGlobalReturnableNumberOfDaysPlugin;
use Spryker\Zed\SalesReturn\Communication\Plugin\Sales\UpdateOrderItemIsReturnableByItemStatePlugin;
use Spryker\Zed\Shipment\Communication\Plugin\ShipmentOrderHydratePlugin;

class SalesDependencyProvider extends SprykerSalesDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\SalesExtension\Dependency\Plugin\OrderExpanderPreSavePluginInterface>
     */
    protected function getOrderExpanderPreSavePlugins(): array
    {
        return [
            new OmsMultiThreadProcessorIdentifierOrderExpanderPreSavePlugin(),
            new AgentOrderExpanderPreSavePlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\SalesExtension\Dependency\Plugin\OrderExpanderPluginInterface>
     */
    protected function getOrderHydrationPlugins(): array
    {
        return [
            new ProductBundleOrderHydratePlugin(),
            new DiscountOrderHydratePlugin(),
            new ShipmentOrderHydratePlugin(),
            new SalesPaymentOrderExpanderPlugin(),
            new CustomerOrderHydratePlugin(),
            new ProductBundleIdHydratorPlugin(),
            new ProductOptionGroupIdHydratorPlugin(),
            new CommentThreadOrderExpanderPlugin(),
            new ProductBundleOptionOrderExpanderPlugin(),
            new RemunerationTotalOrderExpanderPlugin(),
            new OmsStatesOrderExpanderPlugin(),
            new IsCancellableOrderExpanderPlugin(),
            new CurrencyOrderExpanderPlugin(),
            new SalesOrderAmendmentOrderExpanderPlugin(),
            new IsAmendableOrderExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\SalesExtension\Dependency\Plugin\OrderItemExpanderPreSavePluginInterface>
     */
    protected function getOrderItemExpanderPreSavePlugins(): array
    {
        return [
            new QuantitySalesUnitOrderItemExpanderPreSavePlugin(),
            new ProductPackagingUnitOrderItemExpanderPreSavePlugin(),
            new AmountSalesUnitOrderItemExpanderPreSavePlugin(),
            new IsQuantitySplittableOrderItemExpanderPreSavePlugin(),
            new OrderItemReferenceExpanderPreSavePlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\SalesExtension\Dependency\Plugin\ItemTransformerStrategyPluginInterface>
     */
    public function getItemTransformerStrategyPlugins(): array
    {
        return [
            new PackagingUnitSplittableItemTransformerStrategyPlugin(), #ProductPackagingUnit
            new NonSplittableItemTransformerStrategyPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\SalesExtension\Dependency\Plugin\SalesTablePluginInterface>
     */
    protected function getSalesTablePlugins(): array
    {
        return [
            new ReclamationSalesTablePlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\SalesExtension\Dependency\Plugin\OrderPostSavePluginInterface>
     */
    protected function getOrderPostSavePlugins(): array
    {
        return [
            new CommentThreadAttachedCommentOrderPostSavePlugin(),
            new OrderCustomReferenceOrderPostSavePlugin(),
            new SaveCompanyBusinessUnitUuidOrderPostSavePlugin(),
            new SaveCompanyUuidOrderPostSavePlugin(),
            new QuoteRequestVersionReferenceOrderPostSavePlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\SalesExtension\Dependency\Plugin\OrderPostSavePluginInterface>
     */
    protected function getOrderPostSavePluginsForOrderAmendment(): array
    {
        return [
            new SaveOrderCommentThreadOrderPostSavePlugin(),
            new UpdateOrderCustomReferenceOrderPostSavePlugin(),
            new SaveCompanyBusinessUnitUuidOrderPostSavePlugin(),
            new SaveCompanyUuidOrderPostSavePlugin(),
            new CreateSalesOrderAmendmentOrderPostSavePlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\SalesExtension\Dependency\Plugin\ItemPreTransformerPluginInterface>
     */
    protected function getItemPreTransformerPlugins(): array
    {
        return [
            new ConfiguredBundleItemPreTransformerPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\SalesExtension\Dependency\Plugin\UniqueOrderItemsExpanderPluginInterface>
     */
    protected function getUniqueOrderItemsExpanderPlugins(): array
    {
        return [
            new UniqueOrderBundleItemsExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\SalesExtension\Dependency\Plugin\OrderItemExpanderPluginInterface>
     */
    protected function getOrderItemExpanderPlugins(): array
    {
        return [
            new StateHistoryOrderItemExpanderPlugin(),
            new ProductIdOrderItemExpanderPlugin(),
            new ProductOptionsOrderItemExpanderPlugin(),
            new MetadataOrderItemExpanderPlugin(),
            new UpdateOrderItemIsReturnableByItemStatePlugin(),
            new UpdateOrderItemIsReturnableByGlobalReturnableNumberOfDaysPlugin(),
            new CurrencyIsoCodeOrderItemExpanderPlugin(),
            new ConfiguredBundleOrderItemExpanderPlugin(),
            new ProductBundleOrderItemExpanderPlugin(),
            new ProductBundleOptionItemExpanderPlugin(),
            new QuantitySalesUnitOrderItemExpanderPlugin(),
            new AmountLeadProductOrderItemExpanderPlugin(),
            new AmountSalesUnitOrderItemExpanderPlugin(),
            new ItemStateOrderItemExpanderPlugin(),
            new ProductConfigurationOrderItemExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\SalesExtension\Dependency\Plugin\SearchOrderExpanderPluginInterface>
     */
    protected function getSearchOrderExpanderPlugins(): array
    {
        return [
            new ItemMetadataSearchOrderExpanderPlugin(),
            new OrderAggregatedItemStateSearchOrderExpanderPlugin(),
            new IsCancellableSearchOrderExpanderPlugin(),
            new IsAmendableOrderSearchOrderExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\SalesExtension\Dependency\Plugin\SearchOrderQueryExpanderPluginInterface>
     */
    protected function getOrderSearchQueryExpanderPlugins(): array
    {
        return [
            new CompanyBusinessUnitFilterOrderSearchQueryExpanderPlugin(),
            new CompanyFilterOrderSearchQueryExpanderPlugin(),
            new CompanyBusinessUnitCustomerFilterOrderSearchQueryExpanderPlugin(),
            new CompanyBusinessUnitCustomerSortingOrderSearchQueryExpanderPlugin(),
            new CompanyCustomerFilterOrderSearchQueryExpanderPlugin(),
            new CompanyCustomerSortingOrderSearchQueryExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\SalesExtension\Dependency\Plugin\CustomerOrderAccessCheckPluginInterface>
     */
    protected function getCustomerOrderAccessCheckPlugins(): array
    {
        return [
            new CompanyBusinessUnitCustomerOrderAccessCheckPlugin(),
            new CompanyCustomerOrderAccessCheckPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\SalesExtension\Dependency\Plugin\OrderItemsPostSavePluginInterface>
     */
    protected function getOrderItemsPostSavePlugins(): array
    {
        return [
            new ConfiguredBundlesOrderItemsPostSavePlugin(),
            new ItemMetadataOrderItemsPostSavePlugin(),
            new ProductConfigurationOrderItemsPostSavePlugin(),
            new ProductOptionOrderItemsPostSavePlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\SalesExtension\Dependency\Plugin\SalesExpensePreDeletePluginInterface>
     */
    protected function getSalesExpensePreDeletePlugins(): array
    {
        return [
            new SalesDiscountSalesExpensePreDeletePlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\SalesExtension\Dependency\Plugin\SalesOrderItemCollectionPreDeletePluginInterface>
     */
    protected function getSalesOrderItemCollectionPreDeletePlugins(): array
    {
        return [
            new DiscountSalesOrderItemCollectionPreDeletePlugin(),
            new ItemMetadataSalesOrderItemCollectionPreDeletePlugin(),
            new OmsItemHistorySalesOrderItemCollectionPreDeletePlugin(),
            new ProductOptionSalesOrderItemCollectionPreDeletePlugin(),
            new SalesConfigurableBundleSalesOrderItemCollectionPreDeletePlugin(),
            new SalesProductConfigurationSalesOrderItemCollectionPreDeletePlugin(),
            new NopaymentSalesOrderItemCollectionPreDeletePlugin(),
            new SalesReclamationSalesOrderItemCollectionPreDeletePlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\SalesExtension\Dependency\Plugin\SalesOrderItemCollectionPostUpdatePluginInterface>
     */
    protected function getOrderItemCollectionPostUpdatePlugins(): array
    {
        return [
            new SalesConfiguredBundlesSalesOrderItemCollectionPostUpdatePlugin(),
            new SalesProductConfigurationSalesOrderItemCollectionPostUpdatePlugin(),
            new ItemMetadataSalesOrderItemCollectionPostUpdatePlugin(),
            new ProductOptionSalesOrderItemCollectionPostUpdatePlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\SalesExtension\Dependency\Plugin\OrderItemInitialStateProviderPluginInterface>
     */
    protected function getOrderItemInitialStateProviderPlugins(): array
    {
        return [
            new DefaultOrderItemInitialStateProviderPlugin(),
        ];
    }

    /**
     * @return list<\Spryker\Zed\SalesExtension\Dependency\Plugin\OrderItemInitialStateProviderPluginInterface>
     */
    protected function getOrderItemInitialStateProviderPluginsForOrderAmendment(): array
    {
        return [
            new OrderAmendmentDefaultOrderItemInitialStateProviderPlugin(),
        ];
    }
}
