<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\Customer\PageObject;

class CustomerOverviewPage
{
    /**
     * @var string
     */
    public const URL = '/en/customer/overview';

    /**
     * @var string
     */
    public const BOX_HEADLINE_ORDERS = 'Last orders';

    /**
     * @var string
     */
    public const BOX_HEADLINE_PROFILE = 'Profile';

    /**
     * @var string
     */
    public const BOX_HEADLINE_NEWSLETTER = 'Newsletter';

    /**
     * @var string
     */
    public const MESSAGE_SUCCESS_NEWSLETTER_SUBSCRIBED = 'You successfully subscribed to the newsletter';

    /**
     * @var string
     */
    public const LINK_TO_PROFILE_PAGE = '//a[@class=\'navigation-sidebar-item__link\' and @href=\'/en/customer/profile\']';

    /**
     * @var string
     */
    public const LINK_TO_ADDRESSES_PAGE = '//a[@class=\'navigation-sidebar-item__link\' and @href=\'/en/customer/address\']';

    /**
     * @var string
     */
    public const LINK_TO_ORDERS_PAGE = '//a[@class=\'navigation-sidebar-item__link\' and @href=\'/en/customer/order\']';

    /**
     * @var string
     */
    public const LINK_TO_NEWSLETTER_PAGE = '//a[@class=\'navigation-sidebar-item__link\' and @href=\'/en/customer/newsletter\']';
}
