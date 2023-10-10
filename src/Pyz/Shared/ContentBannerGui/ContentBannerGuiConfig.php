<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Shared\ContentBannerGui;

use Spryker\Shared\ContentBannerGui\ContentBannerGuiConfig as SprykerContentBannerGuiConfig;

class ContentBannerGuiConfig extends SprykerContentBannerGuiConfig
{
    /**
     * @var string
     *
     * @uses \Pyz\Shared\ContentBanner\ContentBannerConfig::WIDGET_TEMPLATE_IDENTIFIER_HOME_PAGE
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_HOME_PAGE = 'home-page';

    /**
     * @var string
     *
     * Content item banner home page template name
     */
    protected const WIDGET_TEMPLATE_DISPLAY_NAME_HOME_PAGE = 'content_banner.template.home-page';

    /**
     * @return array<string, string>
     */
    public function getContentWidgetTemplates(): array
    {
        $contentWidgetTemplates = parent::getContentWidgetTemplates();

        return [
            static::WIDGET_TEMPLATE_IDENTIFIER_HOME_PAGE => static::WIDGET_TEMPLATE_DISPLAY_NAME_HOME_PAGE,
        ] + $contentWidgetTemplates;
    }
}
