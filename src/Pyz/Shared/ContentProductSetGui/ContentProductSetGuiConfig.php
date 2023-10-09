<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Shared\ContentProductSetGui;

use Spryker\Shared\ContentProductSetGui\ContentProductSetGuiConfig as SprykerContentProductSetGuiConfig;

class ContentProductSetGuiConfig extends SprykerContentProductSetGuiConfig
{
    /**
     * @var string
     *
     * @uses \Pyz\Shared\ContentProductSet\ContentProductSetConfig::WIDGET_TEMPLATE_IDENTIFIER_LANDING_PAGE
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LANDING_PAGE = 'landing-page';

    /**
     * @var string
     *
     * Content item product set landing page template name
     */
    protected const WIDGET_TEMPLATE_DISPLAY_NAME_LANDING_PAGE = 'content_product_set_gui.template.landing-page';

    /**
     * @return array<string, string>
     */
    public function getContentWidgetTemplates(): array
    {
        $contentWidgetTemplates = parent::getContentWidgetTemplates();

        return [
            static::WIDGET_TEMPLATE_IDENTIFIER_LANDING_PAGE => static::WIDGET_TEMPLATE_DISPLAY_NAME_LANDING_PAGE,
        ] + $contentWidgetTemplates;
    }
}
