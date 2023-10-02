<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ContentBannerWidget\Twig;

use SprykerShop\Yves\ContentBannerWidget\Twig\ContentBannerTwigFunctionProvider as SprykerShopContentBannerTwigFunctionProvider;

class ContentBannerTwigFunctionProvider extends SprykerShopContentBannerTwigFunctionProvider
{
    /**
     * @uses \Pyz\Shared\ContentBanner\ContentBannerConfig::WIDGET_TEMPLATE_IDENTIFIER_HOME_PAGE
     *
     * @var string
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_HOME_PAGE = 'home-page';

    /**
     * @return array<string, string>
     */
    protected function getAvailableTemplates(): array
    {
        $contentWidgetTemplates = parent::getAvailableTemplates();

        return [
                static::WIDGET_TEMPLATE_IDENTIFIER_HOME_PAGE => '@ContentBannerWidget/views/banner-home-page/banner-home-page.twig',
            ] + $contentWidgetTemplates;
    }
}
