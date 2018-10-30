<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ExampleProductColorGroupWidget\Plugin\ProductWidget;

use Pyz\Yves\ExampleProductColorGroupWidget\Widget\ExampleProductColorSelectorWidget;
use Spryker\Yves\Kernel\Widget\AbstractWidgetPlugin;
use SprykerShop\Yves\ProductWidget\Dependency\Plugin\ProductGroupWidget\ProductGroupWidgetPluginInterface;

/**
 * @deprecated Use \Yves\ExampleProductColorGroupWidget\Widget\ExampleProductColorSelectorWidget instead.
 */
class ExampleProductColorGroupWidgetPlugin extends AbstractWidgetPlugin implements ProductGroupWidgetPluginInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return void
     */
    public function initialize(int $idProductAbstract): void
    {
        $widget = new ExampleProductColorSelectorWidget($idProductAbstract);

        $this->parameters = $widget->getParameters();
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
        return '@ExampleProductColorGroupWidget/views/product-color-selector-widget/product-color-selector-widget.twig';
    }
}
