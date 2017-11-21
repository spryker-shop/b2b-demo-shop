<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\WebProfiler;

use Spryker\Zed\Config\Communication\Plugin\ServiceProvider\ConfigProfilerServiceProvider;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use SprykerShop\Shared\WebProfilerWidget\Plugin\ServiceProvider\WebProfilerWidgetServiceProvider;

class WebProfilerDependencyProvider extends AbstractBundleDependencyProvider
{
    const PLUGINS_WEB_PROFILER = 'PLUGINS_WEB_PROFILER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container[static::PLUGINS_WEB_PROFILER] = function () {
            return [
                new WebProfilerWidgetServiceProvider(),
                new ConfigProfilerServiceProvider(),
            ];
        };

        return $container;
    }
}
