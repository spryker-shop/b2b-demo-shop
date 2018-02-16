<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CmsContentWidgetChartConnector;

use Spryker\Yves\CmsContentWidgetChartConnector\CmsContentWidgetChartConnectorDependencyProvider as SprykerCmsContentWidgetChartConnectorDependencyProvider;
use SprykerShop\Yves\ChartWidget\Plugin\CmsContentWidget\ChartWidgetPlugin;

class CmsContentWidgetChartConnectorDependencyProvider extends SprykerCmsContentWidgetChartConnectorDependencyProvider
{
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
