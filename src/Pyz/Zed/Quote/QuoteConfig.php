<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Quote;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Quote\QuoteConfig as SprykerQuoteConfig;

class QuoteConfig extends SprykerQuoteConfig
{
    /**
     * @return array
     */
    public function getQuoteFieldsAllowedForSaving()
    {
        return array_merge(parent::getQuoteFieldsAllowedForSaving(), [
            QuoteTransfer::BUNDLE_ITEMS,
            QuoteTransfer::CART_NOTE, #CartNoteFeature,
            QuoteTransfer::EXPENSES, #QuoteApprovalFeature
            QuoteTransfer::VOUCHER_DISCOUNTS, #QuoteApprovalFeature
            QuoteTransfer::CART_RULE_DISCOUNTS, #QuoteApprovalFeature
            QuoteTransfer::PROMOTION_ITEMS, #QuoteApprovalFeature
            QuoteTransfer::IS_LOCKED, #QuoteApprovalFeature
        ]);
    }
}
