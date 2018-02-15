<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CmsContentWidgetChartConnector\Dependency\Plugin\ChartWidget;

use Spryker\Yves\Kernel\Dependency\Plugin\WidgetPluginInterface;

interface ChartWidgetPluginInterface extends WidgetPluginInterface
{
    public const NAME = 'ChartWidgetPlugin';

    /**
     * @return void
     */
    public function initialize(): void;
}
