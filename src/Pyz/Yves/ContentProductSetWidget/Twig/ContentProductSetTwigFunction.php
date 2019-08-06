<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ContentProductSetWidget\Twig;

use SprykerShop\Yves\ContentProductSetWidget\Twig\ContentProductSetTwigFunction as SprykerShopContentProductSetTwigFunction;

/**
 * @method \Pyz\Yves\ContentProductSetWidget\ContentProductSetWidgetFactory getFactory()
 */
class ContentProductSetTwigFunction extends SprykerShopContentProductSetTwigFunction
{
    /**
     * @uses \Pyz\Shared\ContentProductSet\ContentProductSetConfig::WIDGET_TEMPLATE_IDENTIFIER_LANDING_PAGE
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LANDING_PAGE = 'landing-page';

    /**
     * @return string[]
     */
    protected function getAvailableTemplates(): array
    {
        $contentWidgetTemplates = parent::getAvailableTemplates();

        return [
            static::WIDGET_TEMPLATE_IDENTIFIER_LANDING_PAGE => '@ContentProductSetWidget/views/content-product-set-landing-page/content-product-set-landing-page.twig',
        ] + $contentWidgetTemplates;
    }
}
