<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\WebProfiler;

use Spryker\Zed\Config\Communication\Plugin\ServiceProvider\ConfigProfilerServiceProvider;
use Spryker\Zed\WebProfiler\WebProfilerDependencyProvider as SprykerWebProfilerDependencyProvider;
use SprykerShop\Yves\WebProfilerWidget\Plugin\ServiceProvider\WebProfilerWidgetServiceProvider;

class WebProfilerDependencyProvider extends SprykerWebProfilerDependencyProvider
{
    /**
     * @return array
     */
    public function getWebProfilerPlugins()
    {
        return [
            new WebProfilerWidgetServiceProvider(),
            new ConfigProfilerServiceProvider(),
        ];
    }
}
