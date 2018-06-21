<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Glue\GlueApplication;

use Spryker\Glue\CartsRestApi\CartsRestApiConfig;
use Spryker\Glue\CartsRestApi\Plugin\CartItemsResourceRoutePlugin;
use Spryker\Glue\CustomersRestApi\Plugin\SetCustomerBeforeActionPlugin;
use Spryker\Glue\GlueApplication\Dependency\Plugin\ResourceRelationshipCollectionInterface;
use Spryker\Glue\GlueApplication\GlueApplicationDependencyProvider as SprykerGlueApplicationDependencyProvider;
use Spryker\Glue\CartsRestApi\Plugin\CartsResourceRoutePlugin;
use Spryker\Glue\CartsRestApi\Plugin\CartVouchersResourceRoutePlugin;
use Spryker\Glue\AuthRestApi\Plugin\AccessTokensResourceRoutePlugin;
use Spryker\Glue\AuthRestApi\Plugin\AccessTokenValidatorPlugin;
use Spryker\Glue\AuthRestApi\Plugin\FormatAuthenticationErrorResponseHeadersPlugin;
use Spryker\Glue\AuthRestApi\Plugin\RefreshTokensResourceRoutePlugin;
use Spryker\Glue\CartsProductsResourceRelationship\Plugin\CartItemsProductsRelationshipPlugin;
use Spryker\Glue\GlueApplication\Plugin\Rest\SetStoreCurrentLocaleBeforeActionPlugin;
use Spryker\Glue\ProductsProductImagesResourceRelationship\Plugin\ProductsProductImagesRelationshipPlugin;
use Spryker\Glue\ProductsRestApi\ProductsRestApiConfig;
use Spryker\Glue\CartsCustomersResourceRelationship\Plugin\CartsCustomersRelationshipPlugin;
use Pyz\Glue\ExampleProductOptionsRestApi\Plugin\ProductOptionsResourceRoutePlugin;

class GlueApplicationDependencyProvider extends SprykerGlueApplicationDependencyProvider
{

    /**
     * {@inheritdoc}
     *
     * @return \Spryker\Glue\GlueApplication\Dependency\Plugin\ResourceRoutePluginInterface[]
     */
    protected function getResourceRoutePlugins(): array
    {
        return [
            new AccessTokensResourceRoutePlugin(),
            new RefreshTokensResourceRoutePlugin(),
            new CartsResourceRoutePlugin(),
            new CartItemsResourceRoutePlugin(),
            new CartVouchersResourceRoutePlugin(),
            new ProductOptionsResourceRoutePlugin(),
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param \Spryker\Glue\GlueApplication\Dependency\Plugin\ResourceRelationshipCollectionInterface $resourceRelationshipCollection
     *
     * @return \Spryker\Glue\GlueApplication\Dependency\Plugin\ResourceRelationshipCollectionInterface
     */
    protected function getResourceRelationshipPlugins(
        ResourceRelationshipCollectionInterface $resourceRelationshipCollection
    ): ResourceRelationshipCollectionInterface {

        $resourceRelationshipCollection
            ->addRelationship(CartsRestApiConfig::RESOURCE_CARTS, new CartsCustomersRelationshipPlugin())
            ->addRelationship(CartsRestApiConfig::RESOURCE_CART_ITEMS, new CartItemsProductsRelationshipPlugin())
            ->addRelationship(ProductsRestApiConfig::RESOURCE_PRODUCTS, new ProductsProductImagesRelationshipPlugin());


        return $resourceRelationshipCollection;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Spryker\Glue\GlueApplication\Dependency\Plugin\ValidateRestRequestPluginInterface[]
     */
    protected function getValidateRestRequestPlugins(): array
    {
        return [
            new AccessTokenValidatorPlugin(),
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @return \Spryker\Glue\GlueApplication\Dependency\Plugin\FormatResponseHeadersPluginInterface[]
     */
    protected function getFormatResponseHeadersPlugins(): array
    {
        return [
           new FormatAuthenticationErrorResponseHeadersPlugin(),
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @return \Spryker\Glue\GlueApplication\Dependency\Plugin\ControllerBeforeActionPluginInterface[]
     */
    protected function getControllerBeforeActionPlugins(): array
    {
        return [
           new SetStoreCurrentLocaleBeforeActionPlugin(),
           new SetCustomerBeforeActionPlugin(),
        ];
    }
}
