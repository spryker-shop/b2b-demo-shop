<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Shared\ContentNavigationGui;

use Spryker\Shared\ContentNavigationGui\ContentNavigationGuiConfig as SprykerContentNavigationGuiConfig;

class ContentNavigationGuiConfig extends SprykerContentNavigationGuiConfig
{
    /**
     * @uses \Pyz\Shared\ContentNavigation\ContentNavigationConfig::WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_HEADER
     *
     * Content item navigation header template identifier.
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_HEADER = 'navigation-header';

    /**
     * @uses \Pyz\Shared\ContentNavigation\ContentNavigationConfig::WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER
     *
     * Content item navigation footer template identifier.
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER = 'navigation-footer';

    /**
     * @uses \Pyz\Shared\ContentNavigation\ContentNavigationConfig::WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER_CHECKOUT
     *
     * Content item navigation footer checkout template identifier.
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER_CHECKOUT = 'navigation-footer-checkout';

    /**
     * @uses \Pyz\Shared\ContentNavigation\ContentNavigationConfig::WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_PARTNERS
     *
     * Content item footer partners template identifier.
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_PARTNERS = 'footer-partners';

    /**
     * @uses \Pyz\Shared\ContentNavigation\ContentNavigationConfig::WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_SOCIAL_LINKS
     *
     * Content item footer social links template identifier.
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_SOCIAL_LINKS = 'footer-social-links';

    /**
     * Content item navigation header template name.
     */
    protected const WIDGET_TEMPLATE_DISPLAY_NAME_LIST_NAVIGATION_HEADER = 'Navigation Header';

    /**
     * Content item navigation footer template name.
     */
    protected const WIDGET_TEMPLATE_DISPLAY_NAME_LIST_NAVIGATION_FOOTER = 'Navigation Footer';

    /**
     * Content item navigation footer checkout template name.
     */
    protected const WIDGET_TEMPLATE_DISPLAY_NAME_LIST_NAVIGATION_FOOTER_CHECKOUT = 'Navigation Footer Checkout';

    /**
     * Content item footer partners template name.
     */
    protected const WIDGET_TEMPLATE_DISPLAY_NAME_LIST_FOOTER_PARTNERS = 'Footer Partners';

    /**
     * Content item footer social links template name.
     */
    protected const WIDGET_TEMPLATE_DISPLAY_NAME_LIST_FOOTER_SOCIAL_LINKS = 'Footer Social Links';

    /**
     * @api
     *
     * @return string[]
     */
    public function getContentWidgetTemplates(): array
    {
        $contentWidgetTemplates = parent::getContentWidgetTemplates();
        $contentWidgetTemplates += [
            static::WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_HEADER => static::WIDGET_TEMPLATE_DISPLAY_NAME_LIST_NAVIGATION_HEADER,
            static::WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER => static::WIDGET_TEMPLATE_DISPLAY_NAME_LIST_NAVIGATION_FOOTER,
            static::WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER_CHECKOUT => static::WIDGET_TEMPLATE_DISPLAY_NAME_LIST_NAVIGATION_FOOTER_CHECKOUT,
            static::WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_PARTNERS => static::WIDGET_TEMPLATE_DISPLAY_NAME_LIST_FOOTER_PARTNERS,
            static::WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_SOCIAL_LINKS => static::WIDGET_TEMPLATE_DISPLAY_NAME_LIST_FOOTER_SOCIAL_LINKS,
        ];

        return $contentWidgetTemplates;
    }
}
