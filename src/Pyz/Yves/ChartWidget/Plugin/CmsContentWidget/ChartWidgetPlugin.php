<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerShop\Yves\ChartWidget\Plugin\CmsContentWidget;

use Pyz\Yves\CmsContentWidgetChartConnector\Dependency\Plugin\ChartWidget\ChartWidgetPluginInterface;
use Spryker\Yves\Kernel\Widget\AbstractWidgetPlugin;

/**
 * @method \Pyz\Yves\ChartWidget\ChartWidgetFactory getFactory()
 */
class ChartWidgetPlugin extends AbstractWidgetPlugin implements ChartWidgetPluginInterface
{
    /**
     * @return void
     */
    public function initialize(): void
    {
        $this
            ->addParameter('chart', [])
            ->addWidgets($this->getFactory()->getCmsContentWidgetChartWidgetPlugins());
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return static::NAME;
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@ChartWidget/_cms-content-widget/chart.twig';
    }
}
