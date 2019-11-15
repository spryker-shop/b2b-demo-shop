<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\Customer\PageObject;

class CustomerOverviewPage
{
    public const URL = '/en/customer/overview';

    public const BOX_HEADLINE_ORDERS = 'Last orders';
    public const BOX_HEADLINE_PROFILE = 'Profile';
    public const BOX_HEADLINE_NEWSLETTER = 'Newsletter';

    public const MESSAGE_SUCCESS_NEWSLETTER_SUBSCRIBED = 'You successfully subscribed to the newsletter';

    public const LINK_TO_PROFILE_PAGE = '//a[@class=\'navigation-sidebar-item__link\' and @href=\'/customer/profile\']';
    public const LINK_TO_ADDRESSES_PAGE = '//a[@class=\'navigation-sidebar-item__link\' and @href=\'/customer/address\']';
    public const LINK_TO_ORDERS_PAGE = '//a[@class=\'navigation-sidebar-item__link\' and @href=\'/customer/order\']';
    public const LINK_TO_NEWSLETTER_PAGE = '//a[@class=\'navigation-sidebar-item__link\' and @href=\'/customer/newsletter\']';
}
