<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\PersistentCart\Zed;

use Generated\Shared\Transfer\PersistentCartChangeTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Spryker\Client\PersistentCart\Zed\PersistentCartStub as SprykerPersistentCartStub;

class PersistentCartStub extends SprykerPersistentCartStub
{
    /**
     * @param \Generated\Shared\Transfer\PersistentCartChangeTransfer $persistentCartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function addItem(PersistentCartChangeTransfer $persistentCartChangeTransfer): QuoteResponseTransfer
    {
        $quoteResponseTransfer = parent::addItem($persistentCartChangeTransfer);

        return $quoteResponseTransfer;
    }
}
