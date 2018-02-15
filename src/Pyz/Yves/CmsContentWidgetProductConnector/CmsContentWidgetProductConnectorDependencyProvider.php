<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CmsContentWidgetProductConnector;

use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\ChartWidget\Plugin\CmsContentWidget\ChartWidgetPlugin;
use SprykerShop\Yves\CmsContentWidgetProductConnector\CmsContentWidgetProductConnectorDependencyProvider as SprykerShopCmsContentWidgetProductConnectorDependencyProvider;
use SprykerShop\Yves\ProductWidget\Plugin\CmsContentWidget\ProductGroupWidgetPlugin;
use SprykerShop\Yves\ProductWidget\Plugin\CmsContentWidget\ProductWidgetPlugin;

class CmsContentWidgetProductConnectorDependencyProvider extends SprykerShopCmsContentWidgetProductConnectorDependencyProvider
{
    const PLUGIN_CMS_CHART_CONTENT_WIDGETS = 'PLUGIN_CMS_CHART_CONTENT_WIDGETS';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = parent::provideDependencies($container);
        $container = $this->addCmsChartContentWidgetPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addCmsChartContentWidgetPlugins(Container $container): Container
    {
        $container[static::PLUGIN_CMS_CHART_CONTENT_WIDGETS] = function () {
            return $this->getCmsChartContentWidgetPlugins();
        };

        return $container;
    }

    /**
     * @return string[]
     */
    protected function getCmsProductContentWidgetPlugins()
    {
        return [
            ProductWidgetPlugin::class,
            ProductGroupWidgetPlugin::class,
        ];
    }

    /**
     * @return string[]
     */
    protected function getCmsChartContentWidgetPlugins()
    {
        return [
            ChartWidgetPlugin::class,
        ];
    }
}
