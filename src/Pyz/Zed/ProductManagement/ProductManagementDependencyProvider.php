<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ProductManagement;

use Spryker\Zed\CmsBlockProductConnector\Communication\Plugin\CmsBlockProductAbstractBlockListViewPlugin;
use Spryker\Zed\Kernel\Communication\Form\FormTypeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\MoneyGui\Communication\Plugin\Form\MoneyFormTypePlugin;
use Spryker\Zed\PriceProductMerchantRelationshipGui\Communication\Plugin\ProductManagement\MerchantRelationshipProductAbstractFormExpanderPlugin;
use Spryker\Zed\PriceProductMerchantRelationshipGui\Communication\Plugin\ProductManagement\MerchantRelationshipProductConcreteFormExpanderPlugin;
use Spryker\Zed\PriceProductScheduleGui\Communication\Plugin\ProductManagement\ScheduledPriceProductAbstractEditViewExpanderPlugin;
use Spryker\Zed\PriceProductScheduleGui\Communication\Plugin\ProductManagement\ScheduledPriceProductAbstractFormEditTabsExpanderPlugin;
use Spryker\Zed\PriceProductScheduleGui\Communication\Plugin\ProductManagement\ScheduledPriceProductConcreteEditViewExpanderPlugin;
use Spryker\Zed\PriceProductScheduleGui\Communication\Plugin\ProductManagement\ScheduledPriceProductConcreteFormEditTabsExpanderPlugin;
use Spryker\Zed\ProductAlternativeGui\Communication\Plugin\ProductManagement\ProductConcreteEditFormExpanderPlugin;
use Spryker\Zed\ProductAlternativeGui\Communication\Plugin\ProductManagement\ProductConcreteFormEditDataProviderExpanderPlugin;
use Spryker\Zed\ProductAlternativeGui\Communication\Plugin\ProductManagement\ProductConcreteFormEditTabsExpanderPlugin;
use Spryker\Zed\ProductAlternativeGui\Communication\Plugin\ProductManagement\ProductFormTransferMapperExpanderPlugin;
use Spryker\Zed\ProductConfigurationGui\Communication\Plugin\ProductManagement\ProductConfigurationProductTableDataBulkExpanderPlugin;
use Spryker\Zed\ProductDiscontinuedGui\Communication\Plugin\DiscontinuedNotesProductFormTransferMapperExpanderPlugin;
use Spryker\Zed\ProductDiscontinuedGui\Communication\Plugin\DiscontinuedProductConcreteEditFormExpanderPlugin;
use Spryker\Zed\ProductDiscontinuedGui\Communication\Plugin\DiscontinueProductConcreteFormEditDataProviderExpanderPlugin;
use Spryker\Zed\ProductDiscontinuedGui\Communication\Plugin\DiscontinueProductConcreteFormEditTabsExpanderPlugin;
use Spryker\Zed\ProductManagement\ProductManagementDependencyProvider as SprykerProductManagementDependencyProvider;
use Spryker\Zed\Store\Communication\Plugin\Form\StoreRelationToggleFormTypePlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\ProductManagement\ProductAbstractTypeFormExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\ProductManagement\ProductAbstractTypeProductAbstractFormDataProviderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\ProductManagement\ProductAbstractTypeProductAbstractTransferMapperPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\ProductManagement\ServiceDateTimeEnabledProductConcreteFormEditDataProviderExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\ProductManagement\ServiceDateTimeEnabledProductConcreteFormExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\ProductManagement\ServiceDateTimeEnabledProductFormTransferMapperExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\ProductManagement\ShipmentTypeProductConcreteFormEditDataProviderExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\ProductManagement\ShipmentTypeProductConcreteFormExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\ProductManagement\ShipmentTypeProductFormTransferMapperExpanderPlugin;

class ProductManagementDependencyProvider extends SprykerProductManagementDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\ProductManagement\Communication\Plugin\ProductAbstractViewPluginInterface>
     */
    protected function getProductAbstractViewPlugins(): array
    {
        return [
            new CmsBlockProductAbstractBlockListViewPlugin(),
        ];
    }

    /**
     * @return \Spryker\Zed\Kernel\Communication\Form\FormTypeInterface
     */
    protected function getStoreRelationFormTypePlugin(): FormTypeInterface
    {
        return new StoreRelationToggleFormTypePlugin();
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Communication\Form\FormTypeInterface
     */
    protected function createMoneyFormTypePlugin(Container $container): FormTypeInterface // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        return new MoneyFormTypePlugin();
    }

    /**
     * @return array<\Spryker\Zed\ProductManagementExtension\Dependency\Plugin\ProductConcreteFormEditTabsExpanderPluginInterface>
     */
    protected function getProductConcreteFormEditTabsExpanderPlugins(): array
    {
        return [
            new DiscontinueProductConcreteFormEditTabsExpanderPlugin(), #ProductDiscontinuedFeature
            new ProductConcreteFormEditTabsExpanderPlugin(), #ProductAlternativeFeature
            new ScheduledPriceProductConcreteFormEditTabsExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductManagementExtension\Dependency\Plugin\ProductConcreteEditFormExpanderPluginInterface>
     */
    protected function getProductConcreteEditFormExpanderPlugins(): array
    {
        return [
            new DiscontinuedProductConcreteEditFormExpanderPlugin(), #ProductDiscontinuedFeature
            new ProductConcreteEditFormExpanderPlugin(), #ProductAlternativeFeature
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductManagementExtension\Dependency\Plugin\ProductConcreteFormEditDataProviderExpanderPluginInterface>
     */
    protected function getProductConcreteFormEditDataProviderExpanderPlugins(): array
    {
        return [
            new DiscontinueProductConcreteFormEditDataProviderExpanderPlugin(), #ProductDiscontinuedFeature
            new ProductConcreteFormEditDataProviderExpanderPlugin(), #ProductAlternativeFeature
            new ShipmentTypeProductConcreteFormEditDataProviderExpanderPlugin(),
            new ServiceDateTimeEnabledProductConcreteFormEditDataProviderExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductManagementExtension\Dependency\Plugin\ProductFormTransferMapperExpanderPluginInterface>
     */
    protected function getProductFormTransferMapperExpanderPlugins(): array
    {
        return [
            new ProductFormTransferMapperExpanderPlugin(), #ProductAlternativeFeature
            new DiscontinuedNotesProductFormTransferMapperExpanderPlugin(), #ProductDiscontinuedFeature
            new ShipmentTypeProductFormTransferMapperExpanderPlugin(),
            new ServiceDateTimeEnabledProductFormTransferMapperExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductManagementExtension\Dependency\Plugin\ProductAbstractFormExpanderPluginInterface>
     */
    protected function getProductAbstractFormExpanderPlugins(): array
    {
        return [
            new MerchantRelationshipProductAbstractFormExpanderPlugin(),
            new ProductAbstractTypeFormExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductManagementExtension\Dependency\Plugin\ProductConcreteFormExpanderPluginInterface>
     */
    protected function getProductConcreteFormExpanderPlugins(): array
    {
        return [
            new MerchantRelationshipProductConcreteFormExpanderPlugin(),
            new ShipmentTypeProductConcreteFormExpanderPlugin(),
            new ServiceDateTimeEnabledProductConcreteFormExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductManagementExtension\Dependency\Plugin\ProductAbstractFormEditTabsExpanderPluginInterface>
     */
    protected function getProductAbstractFormEditTabsExpanderPlugins(): array
    {
        return [
            new ScheduledPriceProductAbstractFormEditTabsExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductManagementExtension\Dependency\Plugin\ProductAbstractEditViewExpanderPluginInterface>
     */
    protected function getProductAbstractEditViewExpanderPlugins(): array
    {
        return [
            new ScheduledPriceProductAbstractEditViewExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductManagementExtension\Dependency\Plugin\ProductConcreteEditViewExpanderPluginInterface>
     */
    protected function getProductConcreteEditViewExpanderPlugins(): array
    {
        return [
            new ScheduledPriceProductConcreteEditViewExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductManagementExtension\Dependency\Plugin\ProductTableDataBulkExpanderPluginInterface>
     */
    protected function getProductTableDataBulkExpanderPlugins(): array
    {
        return [
            new ProductConfigurationProductTableDataBulkExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductManagementExtension\Dependency\Plugin\ProductAbstractFormDataProviderExpanderPluginInterface>
     */
    protected function getProductAbstractFormDataProviderExpanderPlugins(): array
    {
        return [
            new ProductAbstractTypeProductAbstractFormDataProviderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductManagementExtension\Dependency\Plugin\ProductAbstractTransferMapperPluginInterface>
     */
    protected function getProductAbstractTransferMapperPlugins(): array
    {
        return [
            new ProductAbstractTypeProductAbstractTransferMapperPlugin(),
        ];
    }
}
