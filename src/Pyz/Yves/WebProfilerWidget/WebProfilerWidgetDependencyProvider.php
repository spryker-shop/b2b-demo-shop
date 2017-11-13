<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\WebProfilerWidget;

use SprykerShop\Shared\WebProfilerWidget\Plugin\ServiceProvider\WebProfilerWidgetServiceProvider;
use Spryker\Yves\Config\Plugin\ServiceProvider\ConfigProfilerServiceProvider;
use SprykerShop\Yves\WebProfilerWidget\WebProfilerWidgetDependencyProvider as SprykerWebProfilerDependencyProvider ;

class WebProfilerWidgetDependencyProvider extends SprykerWebProfilerDependencyProvider
{

    /**
     * @return array
     */
    protected function getWebProfilerPlugins()
    {
        return [
            new WebProfilerWidgetServiceProvider(),
            new ConfigProfilerServiceProvider(),
        ];
    }

}
