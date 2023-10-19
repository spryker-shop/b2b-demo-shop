<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Shared\ContentNavigation;

use Spryker\Shared\ContentNavigation\ContentNavigationConfig as SprykerContentNavigationConfig;

class ContentNavigationConfig extends SprykerContentNavigationConfig
{
    /**
     * @var string
     *
     * Content item navigation header template identifier.
     */
    public const WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_HEADER = 'navigation-header';

    /**
     * @var string
     *
     * Content item navigation footer template identifier.
     */
    public const WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER = 'navigation-footer';

    /**
     * @var string
     *
     * Content item navigation footer checkout template identifier.
     */
    public const WIDGET_TEMPLATE_IDENTIFIER_LIST_NAVIGATION_FOOTER_CHECKOUT = 'navigation-footer-checkout';

    /**
     * @var string
     *
     * Content item footer partners template identifier.
     */
    public const WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_PARTNERS = 'footer-partners';

    /**
     * @var string
     *
     * Content item footer social links template identifier.
     */
    public const WIDGET_TEMPLATE_IDENTIFIER_LIST_FOOTER_SOCIAL_LINKS = 'footer-social-links';
}
