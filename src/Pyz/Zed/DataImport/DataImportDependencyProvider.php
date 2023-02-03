<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport;

use Spryker\Zed\BusinessOnBehalfDataImport\Communication\Plugin\DataImport\BusinessOnBehalfCompanyUserDataImportPlugin;
use Spryker\Zed\CategoryDataImport\Communication\Plugin\CategoryDataImportPlugin;
use Spryker\Zed\CategoryDataImport\Communication\Plugin\DataImport\CategoryStoreDataImportPlugin;
use Spryker\Zed\CmsPageDataImport\Communication\Plugin\CmsPageDataImportPlugin;
use Spryker\Zed\CmsPageDataImport\Communication\Plugin\CmsPageStoreDataImportPlugin;
use Spryker\Zed\CmsSlotBlockDataImport\Communication\Plugin\CmsSlotBlockDataImportPlugin;
use Spryker\Zed\CmsSlotDataImport\Communication\Plugin\CmsSlotDataImportPlugin;
use Spryker\Zed\CmsSlotDataImport\Communication\Plugin\CmsSlotTemplateDataImportPlugin;
use Spryker\Zed\CommentDataImport\Communication\Plugin\CommentDataImportPlugin;
use Spryker\Zed\CompanyBusinessUnitDataImport\Communication\Plugin\CompanyBusinessUnitAddressDataImportPlugin;
use Spryker\Zed\CompanyBusinessUnitDataImport\Communication\Plugin\CompanyBusinessUnitDataImportPlugin;
use Spryker\Zed\CompanyBusinessUnitDataImport\Communication\Plugin\CompanyBusinessUnitUserDataImportPlugin;
use Spryker\Zed\CompanyDataImport\Communication\Plugin\CompanyDataImportPlugin;
use Spryker\Zed\CompanyRoleDataImport\Communication\Plugin\DataImport\CompanyRoleDataImportPlugin;
use Spryker\Zed\CompanyRoleDataImport\Communication\Plugin\DataImport\CompanyRolePermissionDataImportPlugin;
use Spryker\Zed\CompanyRoleDataImport\Communication\Plugin\DataImport\CompanyUserRoleDataImportPlugin;
use Spryker\Zed\CompanyUnitAddressDataImport\Communication\Plugin\CompanyUnitAddressDataImportPlugin;
use Spryker\Zed\CompanyUnitAddressLabelDataImport\Communication\Plugin\CompanyUnitAddressLabelDataImportPlugin;
use Spryker\Zed\CompanyUnitAddressLabelDataImport\Communication\Plugin\CompanyUnitAddressLabelRelationDataImportPlugin;
use Spryker\Zed\CompanyUserDataImport\Communication\Plugin\DataImport\CompanyUserDataImportPlugin;
use Spryker\Zed\ConfigurableBundleDataImport\Communication\Plugin\ConfigurableBundleTemplateDataImportPlugin;
use Spryker\Zed\ConfigurableBundleDataImport\Communication\Plugin\ConfigurableBundleTemplateImageDataImportPlugin;
use Spryker\Zed\ConfigurableBundleDataImport\Communication\Plugin\ConfigurableBundleTemplateSlotDataImportPlugin;
use Spryker\Zed\ContentBannerDataImport\Communication\Plugin\ContentBannerDataImportPlugin;
use Spryker\Zed\ContentNavigationDataImport\Communication\Plugin\DataImport\ContentNavigationDataImportPlugin;
use Spryker\Zed\ContentProductDataImport\Communication\Plugin\ContentProductAbstractListDataImportPlugin;
use Spryker\Zed\ContentProductSetDataImport\Communication\Plugin\ContentProductSetDataImportPlugin;
use Spryker\Zed\DataImport\Communication\Plugin\DataImportEventBehaviorPlugin;
use Spryker\Zed\DataImport\Communication\Plugin\DataImportPublisherPlugin;
use Spryker\Zed\DataImport\DataImportDependencyProvider as SprykerDataImportDependencyProvider;
use Spryker\Zed\FileManagerDataImport\Communication\Plugin\FileManagerDataImportPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\MerchantDataImport\Communication\Plugin\MerchantDataImportPlugin;
use Spryker\Zed\MerchantDataImport\Communication\Plugin\MerchantStoreDataImportPlugin;
use Spryker\Zed\MerchantRelationshipDataImport\Communication\Plugin\MerchantRelationshipDataImportPlugin;
use Spryker\Zed\MerchantRelationshipProductListDataImport\Communication\Plugin\MerchantRelationshipProductListDataImportPlugin;
use Spryker\Zed\MerchantRelationshipSalesOrderThresholdDataImport\Communication\Plugin\DataImport\MerchantRelationshipSalesOrderThresholdDataImportPlugin;
use Spryker\Zed\MultiCartDataImport\Communication\Plugin\MultiCartDataImportPlugin;
use Spryker\Zed\PaymentDataImport\Communication\Plugin\PaymentMethodDataImportPlugin;
use Spryker\Zed\PaymentDataImport\Communication\Plugin\PaymentMethodStoreDataImportPlugin;
use Spryker\Zed\PriceProductDataImport\Communication\Plugin\PriceProductDataImportPlugin;
use Spryker\Zed\PriceProductMerchantRelationshipDataImport\Communication\Plugin\PriceProductMerchantRelationshipDataImportPlugin;
use Spryker\Zed\PriceProductScheduleDataImport\Communication\Plugin\PriceProductScheduleDataImportPlugin;
use Spryker\Zed\ProductAlternativeDataImport\Communication\Plugin\ProductAlternativeDataImportPlugin;
use Spryker\Zed\ProductConfigurationDataImport\Communication\Plugin\ProductConfigurationDataImportPlugin;
use Spryker\Zed\ProductDiscontinuedDataImport\Communication\Plugin\ProductDiscontinuedDataImportPlugin;
use Spryker\Zed\ProductLabelDataImport\Communication\Plugin\ProductLabelDataImportPlugin;
use Spryker\Zed\ProductLabelDataImport\Communication\Plugin\ProductLabelStoreDataImportPlugin;
use Spryker\Zed\ProductListDataImport\Communication\Plugin\ProductListCategoryDataImportPlugin;
use Spryker\Zed\ProductListDataImport\Communication\Plugin\ProductListDataImportPlugin;
use Spryker\Zed\ProductListDataImport\Communication\Plugin\ProductListProductConcreteDataImportPlugin;
use Spryker\Zed\ProductMeasurementUnitDataImport\Communication\Plugin\ProductMeasurementBaseUnitDataImportPlugin;
use Spryker\Zed\ProductMeasurementUnitDataImport\Communication\Plugin\ProductMeasurementSalesUnitDataImportPlugin;
use Spryker\Zed\ProductMeasurementUnitDataImport\Communication\Plugin\ProductMeasurementSalesUnitStoreDataImportPlugin;
use Spryker\Zed\ProductMeasurementUnitDataImport\Communication\Plugin\ProductMeasurementUnitDataImportPlugin;
use Spryker\Zed\ProductPackagingUnitDataImport\Communication\Plugin\DataImport\ProductPackagingUnitDataImportPlugin;
use Spryker\Zed\ProductPackagingUnitDataImport\Communication\Plugin\DataImport\ProductPackagingUnitTypeDataImportPlugin;
use Spryker\Zed\ProductQuantityDataImport\Communication\Plugin\ProductQuantityDataImportPlugin;
use Spryker\Zed\ProductRelationDataImport\Communication\Plugin\ProductRelationDataImportPlugin;
use Spryker\Zed\ProductRelationDataImport\Communication\Plugin\ProductRelationStoreDataImportPlugin;
use Spryker\Zed\QuoteRequestDataImport\Communication\Plugin\QuoteRequestDataImportPlugin;
use Spryker\Zed\QuoteRequestDataImport\Communication\Plugin\QuoteRequestVersionDataImportPlugin;
use Spryker\Zed\SalesOrderThresholdDataImport\Communication\Plugin\DataImport\SalesOrderThresholdDataImportPlugin;
use Spryker\Zed\SalesReturnDataImport\Communication\Plugin\ReturnReasonDataImportPlugin;
use Spryker\Zed\SharedCartDataImport\Communication\Plugin\SharedCartDataImportPlugin;
use Spryker\Zed\ShipmentDataImport\Communication\Plugin\ShipmentDataImportPlugin;
use Spryker\Zed\ShipmentDataImport\Communication\Plugin\ShipmentMethodPriceDataImportPlugin;
use Spryker\Zed\ShipmentDataImport\Communication\Plugin\ShipmentMethodStoreDataImportPlugin;
use Spryker\Zed\ShoppingListDataImport\Communication\Plugin\ShoppingListCompanyBusinessUnitDataImportPlugin;
use Spryker\Zed\ShoppingListDataImport\Communication\Plugin\ShoppingListCompanyUserDataImportPlugin;
use Spryker\Zed\ShoppingListDataImport\Communication\Plugin\ShoppingListDataImportPlugin;
use Spryker\Zed\ShoppingListDataImport\Communication\Plugin\ShoppingListItemDataImportPlugin;
use Spryker\Zed\StockAddressDataImport\Communication\Plugin\DataImport\StockAddressDataImportPlugin;
use Spryker\Zed\StockDataImport\Communication\Plugin\StockDataImportPlugin;
use Spryker\Zed\StockDataImport\Communication\Plugin\StockStoreDataImportPlugin;

class DataImportDependencyProvider extends SprykerDataImportDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_AVAILABILITY = 'availability facade';

    /**
     * @var string
     */
    public const FACADE_CATEGORY = 'category facade';

    /**
     * @var string
     */
    public const FACADE_PRODUCT_BUNDLE = 'product bundle facade';

    /**
     * @var string
     */
    public const FACADE_PRODUCT_RELATION = 'product relation facade';

    /**
     * @var string
     */
    public const FACADE_PRODUCT_SEARCH = 'product search facade';

    /**
     * @var string
     */
    public const FACADE_CURRENCY = 'FACADE_CURRENCY';

    /**
     * @var string
     */
    public const FACADE_PRICE_PRODUCT = 'FACADE_PRICE_PRODUCT';

    /**
     * @var string
     */
    public const FACADE_STOCK = 'FACADE_STOCK';

    /**
     * @var string
     */
    public const FACADE_STORE = 'FACADE_STORE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addAvailabilityFacade($container);
        $container = $this->addCategoryFacade($container);
        $container = $this->addProductBundleFacade($container);
        $container = $this->addProductRelationFacade($container);
        $container = $this->addProductSearchFacade($container);
        $container = $this->addCurrencyFacade($container);
        $container = $this->addPriceProductFacade($container);
        $container = $this->addStockFacade($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCurrencyFacade(Container $container): Container
    {
        $container->set(static::FACADE_CURRENCY, function (Container $container) {
            return $container->getLocator()->currency()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPriceProductFacade(Container $container): Container
    {
        $container->set(static::FACADE_PRICE_PRODUCT, function (Container $container) {
            return $container->getLocator()->priceProduct()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStockFacade(Container $container): Container
    {
        $container->set(static::FACADE_STOCK, function (Container $container) {
            return $container->getLocator()->stock()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container->set(static::FACADE_STORE, function (Container $container) {
            return $container->getLocator()->store()->facade();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAvailabilityFacade(Container $container): Container
    {
        $container[static::FACADE_AVAILABILITY] = function (Container $container) {
            return $container->getLocator()->availability()->facade();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCategoryFacade(Container $container): Container
    {
        $container[static::FACADE_CATEGORY] = function (Container $container) {
            return $container->getLocator()->category()->facade();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductBundleFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT_BUNDLE] = function (Container $container) {
            return $container->getLocator()->productBundle()->facade();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductSearchFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT_SEARCH] = function (Container $container) {
            return $container->getLocator()->productSearch()->facade();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductRelationFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT_RELATION] = function (Container $container) {
            return $container->getLocator()->productRelation()->facade();
        };

        return $container;
    }

    /**
     * @return array
     */
    protected function getDataImporterPlugins(): array
    {
        return [
            new CategoryDataImportPlugin(),
            new CmsPageDataImportPlugin(),
            new CmsPageStoreDataImportPlugin(),
            new CompanyDataImportPlugin(),
            new CompanyBusinessUnitDataImportPlugin(),
            new CompanyUnitAddressDataImportPlugin(),
            new CompanyUnitAddressLabelDataImportPlugin(),
            new CompanyUnitAddressLabelRelationDataImportPlugin(),
            new ProductDiscontinuedDataImportPlugin(), #ProductDiscontinuedFeature
            new ProductMeasurementUnitDataImportPlugin(),
            new ProductMeasurementBaseUnitDataImportPlugin(),
            new ProductMeasurementSalesUnitDataImportPlugin(),
            new ProductMeasurementSalesUnitStoreDataImportPlugin(),
            new ProductQuantityDataImportPlugin(),
            new ProductAlternativeDataImportPlugin(), #ProductAlternativeFeature
            new ProductPackagingUnitTypeDataImportPlugin(),
            new ProductPackagingUnitDataImportPlugin(),
            new BusinessOnBehalfCompanyUserDataImportPlugin(),
            new SalesOrderThresholdDataImportPlugin(),
            new MerchantDataImportPlugin(),
            new MerchantStoreDataImportPlugin(),
            new MerchantRelationshipDataImportPlugin(),
            new MerchantRelationshipSalesOrderThresholdDataImportPlugin(),
            new ProductListDataImportPlugin(),
            new ProductListCategoryDataImportPlugin(),
            new ProductListProductConcreteDataImportPlugin(),
            new MerchantRelationshipProductListDataImportPlugin(),
            new PriceProductDataImportPlugin(),
            new PriceProductMerchantRelationshipDataImportPlugin(),
            new FileManagerDataImportPlugin(),
            new CompanyUserDataImportPlugin(),
            new CompanyRoleDataImportPlugin(),
            new CompanyRolePermissionDataImportPlugin(),
            new CompanyUserRoleDataImportPlugin(),
            new CompanyBusinessUnitUserDataImportPlugin(),
            new CompanyBusinessUnitAddressDataImportPlugin(),
            new MultiCartDataImportPlugin(),
            new SharedCartDataImportPlugin(),
            new ShoppingListDataImportPlugin(),
            new ShoppingListItemDataImportPlugin(),
            new ShoppingListCompanyUserDataImportPlugin(),
            new ShoppingListCompanyBusinessUnitDataImportPlugin(),
            new QuoteRequestDataImportPlugin(),
            new QuoteRequestVersionDataImportPlugin(),
            new PriceProductScheduleDataImportPlugin(),
            new ContentBannerDataImportPlugin(),
            new ContentProductAbstractListDataImportPlugin(),
            new ContentProductSetDataImportPlugin(),
            new CommentDataImportPlugin(),
            new ConfigurableBundleTemplateDataImportPlugin(),
            new ConfigurableBundleTemplateSlotDataImportPlugin(),
            new ConfigurableBundleTemplateImageDataImportPlugin(),
            new ShipmentDataImportPlugin(),
            new ShipmentMethodPriceDataImportPlugin(),
            new ShipmentMethodStoreDataImportPlugin(),
            new StockDataImportPlugin(),
            new StockStoreDataImportPlugin(),
            new StockAddressDataImportPlugin(),
            new PaymentMethodDataImportPlugin(),
            new PaymentMethodStoreDataImportPlugin(),
            new ProductRelationDataImportPlugin(),
            new ProductRelationStoreDataImportPlugin(),
            new ProductLabelDataImportPlugin(),
            new ProductLabelStoreDataImportPlugin(),
            new ReturnReasonDataImportPlugin(),

            new CmsSlotTemplateDataImportPlugin(),
            new CmsSlotDataImportPlugin(),
            new CmsSlotBlockDataImportPlugin(),
            new ContentNavigationDataImportPlugin(),
            new CategoryStoreDataImportPlugin(),
            new ProductConfigurationDataImportPlugin(),
        ];
    }

    /**
     * @return array
     */
    protected function getDataImportBeforeImportHookPlugins(): array
    {
        return [
            new DataImportEventBehaviorPlugin(),
        ];
    }

    /**
     * @return array
     */
    protected function getDataImportAfterImportHookPlugins(): array
    {
        return [
            new DataImportEventBehaviorPlugin(),
            new DataImportPublisherPlugin(),
        ];
    }
}
