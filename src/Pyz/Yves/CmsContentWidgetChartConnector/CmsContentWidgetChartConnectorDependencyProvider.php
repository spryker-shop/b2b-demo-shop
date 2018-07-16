<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CmsContentWidgetChartConnector;

use SprykerShop\Yves\ChartWidget\Plugin\CmsContentWidgetChartConnector\ChartWidgetPlugin;
use SprykerShop\Yves\CmsContentWidgetChartConnector\CmsContentWidgetChartConnectorDependencyProvider as SprykerCmsContentWidgetChartConnectorDependencyProvider;

class CmsContentWidgetChartConnectorDependencyProvider extends SprykerCmsContentWidgetChartConnectorDependencyProvider
{
    /**
     * @return string[]
     */
    protected function getCmsChartContentWidgetPlugins(): array
    {
        return [
            ChartWidgetPlugin::class,
        ];
    }
}
