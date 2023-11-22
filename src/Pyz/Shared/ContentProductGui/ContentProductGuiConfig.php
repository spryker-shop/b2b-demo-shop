<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Shared\ContentProductGui;

use Spryker\Shared\ContentProductGui\ContentProductGuiConfig as SprykerContentProductGuiConfig;

class ContentProductGuiConfig extends SprykerContentProductGuiConfig
{
    /**
     * @var string
     *
     * @uses \Pyz\Shared\ContentProduct\ContentProductConfig::WIDGET_TEMPLATE_IDENTIFIER_SLIDER
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_SLIDER = 'slider';

    /**
     * @var string
     *
     * Content item abstract product list slider template name
     */
    protected const WIDGET_TEMPLATE_DISPLAY_NAME_SLIDER = 'content_product_abstract_list.template.slider';

    /**
     * @return array<string, string>
     */
    public function getContentWidgetTemplates(): array
    {
        $contentWidgetTemplates = parent::getContentWidgetTemplates();

        return [
            static::WIDGET_TEMPLATE_IDENTIFIER_SLIDER => static::WIDGET_TEMPLATE_DISPLAY_NAME_SLIDER,
        ] + $contentWidgetTemplates;
    }
}
