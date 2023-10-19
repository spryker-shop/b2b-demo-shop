<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ContentProductWidget\Twig;

use SprykerShop\Yves\ContentProductWidget\Twig\ContentProductAbstractListTwigFunctionProvider as SprykerShopContentProductAbstractListTwigFunctionProvider;

/**
 * @method \Pyz\Yves\ContentProductWidget\ContentProductWidgetFactory getFactory()
 */
class ContentProductAbstractListTwigFunctionProvider extends SprykerShopContentProductAbstractListTwigFunctionProvider
{
    /**
     * @uses \Pyz\Shared\ContentProduct\ContentProductConfig::WIDGET_TEMPLATE_IDENTIFIER_SLIDER
     *
     * @var string
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_SLIDER = 'slider';

    /**
     * @return array<string, string>
     */
    protected function getAvailableTemplates(): array
    {
        $contentWidgetTemplates = parent::getAvailableTemplates();

        return [
                static::WIDGET_TEMPLATE_IDENTIFIER_SLIDER => '@ContentProductWidget/views/cms-product-abstract-slider/cms-product-abstract-slider.twig',
            ] + $contentWidgetTemplates;
    }
}
