<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ContentProductWidget\Twig;

use SprykerShop\Yves\ContentProductWidget\Twig\ContentProductAbstractListTwigFunction as SprykerShopContentProductAbstractListTwigFunction;

/**
 * @method \Pyz\Yves\ContentProductWidget\ContentProductWidgetFactory getFactory()
 */
class ContentProductAbstractListTwigFunction extends SprykerShopContentProductAbstractListTwigFunction
{
    /**
     * @uses \Pyz\Shared\ContentProduct\ContentProductConfig::WIDGET_TEMPLATE_IDENTIFIER_SLIDER
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_SLIDER = 'slider';

    /**
     * @return array
     */
    protected function getAvailableTemplates(): array
    {
        $contentWidgetTemplates = parent::getAvailableTemplates();

        return [
            static::WIDGET_TEMPLATE_IDENTIFIER_SLIDER => '@ContentProductWidget/views/cms-product-abstract-slider/cms-product-abstract-slider.twig',
        ] + $contentWidgetTemplates;
    }
}
