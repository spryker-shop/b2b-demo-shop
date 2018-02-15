<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ChartWidget;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class ChartWidgetDependencyProvider extends AbstractBundleDependencyProvider
{
    const PLUGIN_CMS_CONTENT_WIDGET_CHART_SUB_WIDGETS = 'PLUGIN_CMS_CONTENT_WIDGET_CHART_SUB_WIDGETS';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = $this->addCmsContentWidgetChartSubWidgetPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addCmsContentWidgetChartSubWidgetPlugins(Container $container)
    {
        $container[self::PLUGIN_CMS_CONTENT_WIDGET_CHART_SUB_WIDGETS] = function () {
            return $this->getCmsContentWidgetChartSubWidgetPlugins();
        };

        return $container;
    }

    /**
     * Returns a list of widget plugin class names that implement \Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface.
     *
     * @return string[]
     */
    protected function getCmsContentWidgetChartSubWidgetPlugins(): array
    {
        return [];
    }
}
