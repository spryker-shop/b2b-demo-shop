<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Quote;

use Spryker\Zed\Quote\QuoteConfig as SprykerQuoteConfig;

class QuoteConfig extends SprykerQuoteConfig
{
    /**
     * @return array
     */
    public function getQuoteFieldsAllowedForSaving()
    {
        return [
            'items',
            'totals',
            'currency',
            'price_mode',
            'store',
            'bundle_items',
        ];
    }
}
