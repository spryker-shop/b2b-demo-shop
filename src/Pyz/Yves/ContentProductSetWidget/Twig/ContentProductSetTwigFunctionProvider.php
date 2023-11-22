<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ContentProductSetWidget\Twig;

use SprykerShop\Yves\ContentProductSetWidget\Twig\ContentProductSetTwigFunctionProvider as SprykerShopContentProductSetTwigFunctionProvider;

/**
 * @method \Pyz\Yves\ContentProductSetWidget\ContentProductSetWidgetFactory getFactory()
 */
class ContentProductSetTwigFunctionProvider extends SprykerShopContentProductSetTwigFunctionProvider
{
    /**
     * @uses \Pyz\Shared\ContentProductSet\ContentProductSetConfig::WIDGET_TEMPLATE_IDENTIFIER_LANDING_PAGE
     *
     * @var string
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LANDING_PAGE = 'landing-page';

    /**
     * @return array<string, string>
     */
    protected function getAvailableTemplates(): array
    {
        $contentWidgetTemplates = parent::getAvailableTemplates();

        return [
                static::WIDGET_TEMPLATE_IDENTIFIER_LANDING_PAGE => '@ContentProductSetWidget/views/content-product-set-landing-page/content-product-set-landing-page.twig',
            ] + $contentWidgetTemplates;
    }
}
