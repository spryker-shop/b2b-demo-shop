<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\Product;

use Spryker\Zed\Kernel\Container;
//use Spryker\Zed\MerchantProductApproval\Communication\Plugin\Product\MerchantProductApprovalProductAbstractPreCreatePlugin;
use Spryker\Zed\MerchantProductOffer\Communication\Plugin\Product\MerchantProductOfferProductConcreteExpanderPlugin;
use Spryker\Zed\PriceProduct\Communication\Plugin\Product\PriceProductAbstractPostCreatePlugin;
use Spryker\Zed\PriceProduct\Communication\Plugin\Product\PriceProductConcreteMergerPlugin;
use Spryker\Zed\PriceProduct\Communication\Plugin\Product\PriceProductProductAbstractExpanderPlugin;
use Spryker\Zed\PriceProduct\Communication\Plugin\Product\PriceProductProductConcreteExpanderPlugin;
use Spryker\Zed\PriceProduct\Communication\Plugin\ProductAbstract\PriceProductAbstractAfterCreatePlugin;
use Spryker\Zed\PriceProduct\Communication\Plugin\ProductAbstract\PriceProductAbstractAfterUpdatePlugin;
use Spryker\Zed\PriceProduct\Communication\Plugin\ProductConcrete\PriceProductConcreteAfterCreatePlugin;
use Spryker\Zed\PriceProduct\Communication\Plugin\ProductConcrete\PriceProductConcreteAfterUpdatePlugin;
use Spryker\Zed\Product\ProductDependencyProvider as SprykerProductDependencyProvider;
use Spryker\Zed\ProductAlternativeGui\Communication\Plugin\Product\ProductConcretePluginUpdate as ProductAlternativeGuiProductConcretePluginUpdate;
//use Spryker\Zed\ProductApproval\Communication\Plugin\Product\ApprovalStatusProductConcreteMergerPlugin;
//use Spryker\Zed\ProductApproval\Communication\Plugin\Product\ProductApprovalProductAbstractPreCreatePlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\Product\ProductBundleDeactivatorProductConcreteAfterUpdatePlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\Product\ProductBundleProductConcreteAfterCreatePlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\Product\ProductBundleProductConcreteAfterUpdatePlugin;
use Spryker\Zed\ProductBundle\Communication\Plugin\Product\ProductBundleProductConcreteExpanderPlugin;
use Spryker\Zed\ProductCategory\Communication\Plugin\Product\ProductConcreteCategoriesExpanderPlugin;
use Spryker\Zed\ProductDiscontinued\Communication\Plugin\SaveDiscontinuedNotesProductConcretePluginUpdate;
use Spryker\Zed\ProductDiscontinuedProductBundleConnector\Communication\Plugin\Product\DiscontinuedProductConcreteAfterCreatePlugin;
use Spryker\Zed\ProductDiscontinuedProductBundleConnector\Communication\Plugin\Product\DiscontinuedProductConcreteAfterUpdatePlugin;
use Spryker\Zed\ProductImage\Communication\Plugin\Product\ImageSetProductAbstractPostCreatePlugin;
use Spryker\Zed\ProductImage\Communication\Plugin\Product\ImageSetProductConcreteMergerPlugin;
use Spryker\Zed\ProductImage\Communication\Plugin\Product\ProductImageProductAbstractExpanderPlugin;
use Spryker\Zed\ProductImage\Communication\Plugin\Product\ProductImageProductConcreteExpanderPlugin;
use Spryker\Zed\ProductImage\Communication\Plugin\ProductAbstractAfterCreatePlugin as ImageSetProductAbstractAfterCreatePlugin;
use Spryker\Zed\ProductImage\Communication\Plugin\ProductAbstractAfterUpdatePlugin as ImageSetProductAbstractAfterUpdatePlugin;
use Spryker\Zed\ProductImage\Communication\Plugin\ProductConcreteAfterCreatePlugin as ImageSetProductConcreteAfterCreatePlugin;
use Spryker\Zed\ProductImage\Communication\Plugin\ProductConcreteAfterUpdatePlugin as ImageSetProductConcreteAfterUpdatePlugin;
use Spryker\Zed\ProductLabel\Communication\Plugin\Product\ProductLabelProductConcreteExpanderPlugin;
use Spryker\Zed\ProductReview\Communication\Plugin\Product\ProductReviewProductConcreteExpanderPlugin;
use Spryker\Zed\ProductSearch\Communication\Plugin\Product\ProductSearchProductConcreteExpanderPlugin;
use Spryker\Zed\ProductSearch\Communication\Plugin\ProductConcrete\ProductSearchProductConcreteAfterCreatePlugin;
use Spryker\Zed\ProductSearch\Communication\Plugin\ProductConcrete\ProductSearchProductConcreteAfterUpdatePlugin;
use Spryker\Zed\ProductValidity\Communication\Plugin\Product\ProductValidityProductConcreteExpanderPlugin;
use Spryker\Zed\ProductValidity\Communication\Plugin\ProductValidityCreatePlugin;
use Spryker\Zed\ProductValidity\Communication\Plugin\ProductValidityUpdatePlugin;
use Spryker\Zed\Stock\Communication\Plugin\Product\StockProductConcreteExpanderPlugin;
use Spryker\Zed\Stock\Communication\Plugin\ProductConcreteAfterCreatePlugin as StockProductConcreteAfterCreatePlugin;
use Spryker\Zed\Stock\Communication\Plugin\ProductConcreteAfterUpdatePlugin as StockProductConcreteAfterUpdatePlugin;
use Spryker\Zed\TaxProductConnector\Communication\Plugin\Product\TaxSetProductAbstractExpanderPlugin;
use Spryker\Zed\TaxProductConnector\Communication\Plugin\Product\TaxSetProductAbstractPostCreatePlugin;
use Spryker\Zed\TaxProductConnector\Communication\Plugin\TaxSetProductAbstractAfterCreatePlugin;
use Spryker\Zed\TaxProductConnector\Communication\Plugin\TaxSetProductAbstractAfterUpdatePlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\Product\ProductClassesProductConcreteExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\Product\ProductClassProductConcreteAfterUpdatePlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\Product\ProductClassProductConcretePostCreatePlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\Product\ShipmentTypeProductConcreteExpanderPlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\Product\ShipmentTypeProductConcretePostCreatePlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\Product\ShipmentTypeProductConcretePostUpdatePlugin;

class ProductDependencyProvider extends SprykerProductDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginCreateInterface>
     */
    protected function getProductAbstractBeforeCreatePlugins(Container $container): array // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginCreateInterface>
     */
    protected function getProductAbstractAfterCreatePlugins(Container $container): array // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        return [
            new ImageSetProductAbstractAfterCreatePlugin(),
            new TaxSetProductAbstractAfterCreatePlugin(),
            new PriceProductAbstractAfterCreatePlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginUpdateInterface>
     */
    protected function getProductAbstractBeforeUpdatePlugins(Container $container): array // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginUpdateInterface>
     */
    protected function getProductAbstractAfterUpdatePlugins(Container $container): array // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        return [
            new ImageSetProductAbstractAfterUpdatePlugin(),
            new TaxSetProductAbstractAfterUpdatePlugin(),
            new PriceProductAbstractAfterUpdatePlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\ProductExtension\Dependency\Plugin\ProductConcreteCreatePluginInterface>
     */
    protected function getProductConcreteAfterCreatePlugins(Container $container): array // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        return [
            new ImageSetProductConcreteAfterCreatePlugin(),
            new StockProductConcreteAfterCreatePlugin(),
            new PriceProductConcreteAfterCreatePlugin(),
            new ProductSearchProductConcreteAfterCreatePlugin(),
            new ProductBundleProductConcreteAfterCreatePlugin(),
            new ProductValidityCreatePlugin(),
            new DiscontinuedProductConcreteAfterCreatePlugin(),
            new ShipmentTypeProductConcretePostCreatePlugin(),
            new ProductClassProductConcretePostCreatePlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\Product\Dependency\Plugin\ProductConcretePluginUpdateInterface>
     */
    protected function getProductConcreteBeforeUpdatePlugins(Container $container): array // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        return [
            new ProductAlternativeGuiProductConcretePluginUpdate(), #ProductAlternativeFeature
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\Product\Dependency\Plugin\ProductConcretePluginUpdateInterface>
     */
    protected function getProductConcreteAfterUpdatePlugins(Container $container): array // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        return [
            new ImageSetProductConcreteAfterUpdatePlugin(),
            new StockProductConcreteAfterUpdatePlugin(),
            new PriceProductConcreteAfterUpdatePlugin(),
            new ProductSearchProductConcreteAfterUpdatePlugin(),
            new ProductBundleProductConcreteAfterUpdatePlugin(),
            new ProductValidityUpdatePlugin(),
            new SaveDiscontinuedNotesProductConcretePluginUpdate(),
            new DiscontinuedProductConcreteAfterUpdatePlugin(),
            new ProductBundleDeactivatorProductConcreteAfterUpdatePlugin(),
            new ShipmentTypeProductConcretePostUpdatePlugin(),
            new ProductClassProductConcreteAfterUpdatePlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductExtension\Dependency\Plugin\ProductConcreteExpanderPluginInterface>
     */
    protected function getProductConcreteExpanderPlugins(): array
    {
        return [
            new ProductImageProductConcreteExpanderPlugin(),
            new StockProductConcreteExpanderPlugin(),
            new PriceProductProductConcreteExpanderPlugin(),
            new ProductSearchProductConcreteExpanderPlugin(),
            new ProductBundleProductConcreteExpanderPlugin(),
            new ProductValidityProductConcreteExpanderPlugin(),
            new ProductReviewProductConcreteExpanderPlugin(),
            new ProductConcreteCategoriesExpanderPlugin(),
            new ProductLabelProductConcreteExpanderPlugin(),
            new MerchantProductOfferProductConcreteExpanderPlugin(),
            new ShipmentTypeProductConcreteExpanderPlugin(),
            new ProductClassesProductConcreteExpanderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductExtension\Dependency\Plugin\ProductConcreteMergerPluginInterface>
     */
    protected function getProductConcreteMergerPlugins(): array
    {
        return [
//            new ApprovalStatusProductConcreteMergerPlugin(),
            new ImageSetProductConcreteMergerPlugin(),
            new PriceProductConcreteMergerPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\ProductExtension\Dependency\Plugin\ProductAbstractPostCreatePluginInterface>
     */
    protected function getProductAbstractPostCreatePlugins(): array
    {
        return [
            new ImageSetProductAbstractPostCreatePlugin(),
            new TaxSetProductAbstractPostCreatePlugin(),
            new PriceProductAbstractPostCreatePlugin(),
        ];
    }

    /**
     * The order of execution is important for expanding with correct product approval statuses
     *
     * @return array<\Spryker\Zed\ProductExtension\Dependency\Plugin\ProductAbstractPreCreatePluginInterface>
     */
    protected function getProductAbstractPreCreatePlugins(): array
    {
        return [
//            new MerchantProductApprovalProductAbstractPreCreatePlugin(),
//            new ProductApprovalProductAbstractPreCreatePlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\ProductExtension\Dependency\Plugin\ProductAbstractExpanderPluginInterface>
     */
    protected function getProductAbstractExpanderPlugins(Container $container): array // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter
    {
        return [
            new ProductImageProductAbstractExpanderPlugin(),
            new TaxSetProductAbstractExpanderPlugin(),
            new PriceProductProductAbstractExpanderPlugin(),
        ];
    }
}
