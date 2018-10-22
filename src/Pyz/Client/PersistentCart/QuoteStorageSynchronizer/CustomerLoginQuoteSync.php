<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\PersistentCart\QuoteStorageSynchronizer;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\PersistentCart\QuoteStorageSynchronizer\CustomerLoginQuoteSync as SprykerCustomerLoginQuoteSync;
use Spryker\Shared\Quote\QuoteConfig;

class CustomerLoginQuoteSync extends SprykerCustomerLoginQuoteSync
{
    /**
     * @return void
     */
    public function syncQuoteForCustomer(CustomerTransfer $customerTransfer): void
    {
        if ($this->quoteClient->getStorageStrategy() !== QuoteConfig::STORAGE_STRATEGY_DATABASE) {
            return;
        }

        $quoteTransfer = $this->quoteClient->getQuote();

        if ($quoteTransfer->getCustomerReference()) {
            return;
        }

        parent::syncQuoteForCustomer($customerTransfer);
    }
}
