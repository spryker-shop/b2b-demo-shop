<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\MultiCart;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Client\MultiCart\MultiCartConfig as SprykerMultiCartConfig;

class MultiCartConfig extends SprykerMultiCartConfig
{
    /**
     * @return array<string>
     */
    public function getQuoteFieldsAllowedForQuoteDuplicate(): array
    {
        return array_merge(parent::getQuoteFieldsAllowedForQuoteDuplicate(), [
            QuoteTransfer::BUNDLE_ITEMS,
            QuoteTransfer::CART_NOTE, #CartNoteFeature
        ]);
    }

    /**
     * @return array<string|array<string>>
     */
    public function getQuoteFieldsAllowedForCustomerQuoteCollectionInSession(): array
    {
        return array_merge(parent::getQuoteFieldsAllowedForCustomerQuoteCollectionInSession(), [
            QuoteTransfer::ID_QUOTE,
            QuoteTransfer::ITEMS,
            QuoteTransfer::BUNDLE_ITEMS,
            QuoteTransfer::TOTALS,
            QuoteTransfer::CURRENCY,
            QuoteTransfer::PRICE_MODE,
            QuoteTransfer::NAME,
            QuoteTransfer::IS_DEFAULT,
            QuoteTransfer::CUSTOMER_REFERENCE,
            QuoteTransfer::IS_LOCKED,
        ]);
    }
}
