<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\ProductWidget;

use Pyz\Yves\ExampleProductColorGroupWidget\Plugin\ProductWidget\ExampleProductColorGroupWidgetPlugin;
use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\ProductLabelWidget\Plugin\ProductWidget\ProductAbstractLabelWidgetPlugin;
use SprykerShop\Yves\ProductLabelWidget\Plugin\ProductWidget\ProductLabelWidgetPlugin;
use SprykerShop\Yves\ProductReviewWidget\Plugin\ProductWidget\ProductAbstractReviewWidgetPlugin;
use SprykerShop\Yves\ProductReviewWidget\Plugin\ProductWidget\ProductReviewWidgetPlugin;
use SprykerShop\Yves\ProductWidget\ProductWidgetDependencyProvider as SprykerProductWidgetDependencyProvider;

class ProductWidgetDependencyProvider extends SprykerProductWidgetDependencyProvider
{
    /**
     * Returns a list of widget plugin class names that implement \Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface.
     *
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return string[]
     */
    protected function getProductRelationWidgetSubWidgetPlugins(Container $container): array
    {
        return [
            ProductAbstractLabelWidgetPlugin::class,
            ExampleProductColorGroupWidgetPlugin::class,
            ProductAbstractReviewWidgetPlugin::class,
        ];
    }

    /**
     * Returns a list of widget plugin class names that implement \Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface.
     *
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return string[]
     */
    protected function getCatalogPageSubWidgetPlugins(Container $container): array
    {
        return [
            ProductLabelWidgetPlugin::class,
            ExampleProductColorGroupWidgetPlugin::class,
            ProductReviewWidgetPlugin::class,
        ];
    }

    /**
     * Returns a list of widget plugin class names that implement \Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface.
     *
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return string[]
     */
    protected function getCmsContentWidgetProductSubWidgetPlugins(Container $container): array
    {
        return [
            ProductAbstractLabelWidgetPlugin::class,
            ProductAbstractReviewWidgetPlugin::class,
        ];
    }

    /**
     * Returns a list of widget plugin class names that implement \Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface.
     *
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return string[]
     */
    protected function getCmsContentWidgetProductGroupSubWidgetPlugins(Container $container): array
    {
        return [
            ProductAbstractLabelWidgetPlugin::class,
            ExampleProductColorGroupWidgetPlugin::class,
            ProductAbstractReviewWidgetPlugin::class,
        ];
    }

    /**
     * Returns a list of widget plugin class names that implement \Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface.
     *
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return string[]
     */
    protected function getHomePageSubWidgetPlugins(Container $container): array
    {
        return [
            ProductLabelWidgetPlugin::class,
            ExampleProductColorGroupWidgetPlugin::class,
            ProductReviewWidgetPlugin::class,
        ];
    }
}
