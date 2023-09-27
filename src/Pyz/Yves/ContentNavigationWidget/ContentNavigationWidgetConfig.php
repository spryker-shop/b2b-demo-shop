<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ContentNavigationWidget;

use SprykerShop\Yves\ContentNavigationWidget\ContentNavigationWidgetConfig as SprykerShopContentNavigationWidgetConfig;

class ContentNavigationWidgetConfig extends SprykerShopContentNavigationWidgetConfig
{
    /**
     * @var string
     *
     * @uses \Pyz\Shared\ContentNavigation\ContentNavigationConfig::WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_HEADER
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_HEADER = 'navigation-header';

    /**
     * @var string
     *
     * @uses \Pyz\Shared\ContentNavigation\ContentNavigationConfig::WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER = 'navigation-footer';

    /**
     * @var string
     *
     * @uses \Pyz\Shared\ContentNavigation\ContentNavigationConfig::WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER_CHECKOUT
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER_CHECKOUT = 'navigation-footer-checkout';

    /**
     * @var string
     *
     * @uses \Pyz\Shared\ContentNavigation\ContentNavigationConfig::WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_PARTNERS
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_PARTNERS = 'footer-partners';

    /**
     * @var string
     *
     * @uses \Pyz\Shared\ContentNavigation\ContentNavigationConfig::WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_SOCIAL_LINKS
     */
    protected const WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_SOCIAL_LINKS = 'footer-social-links';

    /**
     * @api
     *
     * @return array<string>
     */
    public function getAvailableTemplateList(): array
    {
        $availableTemplates = parent::getAvailableTemplateList();
        $availableTemplates += [
            static::WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_HEADER => '@ContentNavigationWidget/views/navigation-header/navigation-header.twig',
            static::WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER => '@ContentNavigationWidget/views/navigation-footer/navigation-footer.twig',
            static::WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER_CHECKOUT => '@ContentNavigationWidget/views/navigation-footer-checkout/navigation-footer-checkout.twig',
            static::WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_PARTNERS => '@ContentNavigationWidget/views/footer-partners/footer-partners.twig',
            static::WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_SOCIAL_LINKS => '@ContentNavigationWidget/views/footer-social-links/footer-social-links.twig',
        ];

        return $availableTemplates;
    }
}
