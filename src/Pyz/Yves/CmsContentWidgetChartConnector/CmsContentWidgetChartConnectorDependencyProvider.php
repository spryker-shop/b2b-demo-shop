<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CmsContentWidgetChartConnector;

use Spryker\Yves\CmsContentWidgetChartConnector\CmsContentWidgetChartConnectorDependencyProvider as SprykerCmsContentWidgetChartConnectorDependencyProvider;
use Spryker\Yves\Kernel\Container;

class CmsContentWidgetChartConnectorDependencyProvider extends SprykerCmsContentWidgetChartConnectorDependencyProvider
{
    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = parent::provideDependencies($container);

        return $container;
    }
}
