<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ChartWidget;

use Spryker\Yves\Kernel\AbstractFactory;

class ChartWidgetFactory extends AbstractFactory
{
    /**
     * @return string[]
     */
    public function getCmsContentWidgetChartWidgetPlugins(): array
    {
        return $this->getProvidedDependency(ChartWidgetDependencyProvider::PLUGIN_CMS_CONTENT_WIDGET_CHART_SUB_WIDGETS);
    }
}
