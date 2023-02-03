<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\QuoteRequest;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\QuoteRequest\QuoteRequestConfig as SprykerQuoteRequestConfig;

class QuoteRequestConfig extends SprykerQuoteRequestConfig
{
    /**
     * @return array<string>
     */
    public function getQuoteFieldsAllowedForSaving(): array
    {
        return array_merge(parent::getQuoteFieldsAllowedForSaving(), [
            QuoteTransfer::CUSTOMER_REFERENCE,
            QuoteTransfer::CUSTOMER,
            QuoteTransfer::STORE,
            QuoteTransfer::ITEMS,
            QuoteTransfer::TOTALS,
            QuoteTransfer::CURRENCY,
            QuoteTransfer::PRICE_MODE,
            QuoteTransfer::BUNDLE_ITEMS,
            QuoteTransfer::EXPENSES,
            QuoteTransfer::VOUCHER_DISCOUNTS,
            QuoteTransfer::CART_RULE_DISCOUNTS,
            QuoteTransfer::PROMOTION_ITEMS,
            QuoteTransfer::QUOTE_APPROVALS,
            QuoteTransfer::BILLING_ADDRESS,
            QuoteTransfer::SHIPMENT,
            QuoteTransfer::SHIPPING_ADDRESS,
        ]);
    }
}
