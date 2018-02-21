<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerPage;

use SprykerShop\Yves\CartNotesWidget\Plugin\CustomerPage\CartNotesOrderItemNoteWidgetPlugin;
use SprykerShop\Yves\CartNotesWidget\Plugin\CustomerPage\CartNotesOrderNoteWidgetPlugin;
use SprykerShop\Yves\CustomerPage\CustomerPageDependencyProvider as SprykerShopCustomerPageDependencyProvider;
use SprykerShop\Yves\NewsletterWidget\Plugin\CustomerPage\NewsletterSubscriptionSummaryWidgetPlugin;

class CustomerPageDependencyProvider extends SprykerShopCustomerPageDependencyProvider
{
    /**
     * @return string[]
     */
    protected function getCustomerOverviewWidgetPlugins(): array
    {
        return [
            NewsletterSubscriptionSummaryWidgetPlugin::class,
        ];
    }

    /**
     * @return string[]
     */
    protected function getCustomerOrderDetailsWidgetPlugins(): array
    {
        return [
            CartNotesOrderItemNoteWidgetPlugin::class,
            CartNotesOrderNoteWidgetPlugin::class,
        ];
    }
}
