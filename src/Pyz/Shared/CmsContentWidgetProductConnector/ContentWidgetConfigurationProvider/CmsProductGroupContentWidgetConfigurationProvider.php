<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Shared\CmsContentWidgetProductConnector\ContentWidgetConfigurationProvider;

use SprykerShop\Shared\CmsContentWidgetProductConnector\ContentWidgetConfigurationProvider\CmsProductGroupContentWidgetConfigurationProvider as SprykerCmsProductGroupContentWidgetConfigurationProvider;

class CmsProductGroupContentWidgetConfigurationProvider extends SprykerCmsProductGroupContentWidgetConfigurationProvider
{
    /**
     * @var string
     */
    public const PYZ_SLIDER_TEMPLATE_IDENTIFIER = 'slider';

    /**
     * @return array
     */
    public function getAvailableTemplates(): array
    {
        $availableTemplates = parent::getAvailableTemplates();
        $availableTemplates[static::PYZ_SLIDER_TEMPLATE_IDENTIFIER] = '@CmsContentWidgetProductConnector/views/cms-product-group/cms-product-group-slider.twig';

        return $availableTemplates;
    }
}
