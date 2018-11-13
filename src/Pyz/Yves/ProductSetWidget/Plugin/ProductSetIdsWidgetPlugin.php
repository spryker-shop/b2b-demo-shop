<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ProductSetWidget\Plugin;

use Pyz\Yves\ProductSetWidget\Widget\ProductSetIdsWidget;
use Spryker\Yves\Kernel\Widget\AbstractWidgetPlugin;

/**
 * @deprecated Use \Pyz\Yves\ProductSetWidget\Widget\ProductSetIdsWidget instead.
 *
 * @method \Pyz\Yves\ProductSetWidget\ProductSetWidgetFactory getFactory()
 */
class ProductSetIdsWidgetPlugin extends AbstractWidgetPlugin
{
    public const NAME = 'ProductSetIdsWidgetPlugin';

    /**
     * @param array $productSetIds
     *
     * @return void
     */
    public function initialize(array $productSetIds): void
    {
        $widget = new ProductSetIdsWidget($productSetIds);
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
        return ProductSetIdsWidget::getTemplate();
    }
}
