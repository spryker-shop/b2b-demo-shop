<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerPage;

use SprykerShop\Yves\CustomerPage\CustomerPageDependencyProvider as SprykerShopCustomerPageDependencyProvider;
use SprykerShop\Yves\CustomerReorderWidget\Plugin\CustomerPage\CustomerReorderWidgetPlugin;
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
            CustomerReorderWidgetPlugin::class,
        ];
    }

    /**
     * @return string[]
     */
    protected function getCustomerOrderWidgetPlugins(): array
    {
        return [
            CustomerReorderWidgetPlugin::class,
        ];
    }
}
