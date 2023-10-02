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
     * @var string
     *
     * @uses \Pyz\Shared\ContentNavigation\ContentNavigationConfig::WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_HEADER
     *
     * Content item navigation header template identifier.
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_HEADER = 'navigation-header';

    /**
     * @var string
     *
     * @uses \Pyz\Shared\ContentNavigation\ContentNavigationConfig::WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER
     *
     * Content item navigation footer template identifier.
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER = 'navigation-footer';

    /**
     * @var string
     *
     * @uses \Pyz\Shared\ContentNavigation\ContentNavigationConfig::WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER_CHECKOUT
     *
     * Content item navigation footer checkout template identifier.
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER_CHECKOUT = 'navigation-footer-checkout';

    /**
     * @var string
     *
     * @uses \Pyz\Shared\ContentNavigation\ContentNavigationConfig::WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_PARTNERS
     *
     * Content item footer partners template identifier.
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_PARTNERS = 'footer-partners';

    /**
     * @var string
     *
     * @uses \Pyz\Shared\ContentNavigation\ContentNavigationConfig::WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_SOCIAL_LINKS
     *
     * Content item footer social links template identifier.
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_SOCIAL_LINKS = 'footer-social-links';

    /**
     * @var string
     *
     * Content item navigation header template name.
     */
    protected const WIDGET_TEMPLATE_DISPLAY_NAME_LIST_NAVIGATION_HEADER = 'Navigation Header';

    /**
     * @var string
     *
     * Content item navigation footer template name.
     */
    protected const WIDGET_TEMPLATE_DISPLAY_NAME_LIST_NAVIGATION_FOOTER = 'Navigation Footer';

    /**
     * @var string
     *
     * Content item navigation footer checkout template name.
     */
    protected const WIDGET_TEMPLATE_DISPLAY_NAME_LIST_NAVIGATION_FOOTER_CHECKOUT = 'Navigation Footer Checkout';

    /**
     * @var string
     *
     * Content item footer partners template name.
     */
    protected const WIDGET_TEMPLATE_DISPLAY_NAME_LIST_FOOTER_PARTNERS = 'Footer Partners';

    /**
     * @var string
     *
     * Content item footer social links template name.
     */
    protected const WIDGET_TEMPLATE_DISPLAY_NAME_LIST_FOOTER_SOCIAL_LINKS = 'Footer Social Links';

    /**
     * @api
     *
     * @return array<string>
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
