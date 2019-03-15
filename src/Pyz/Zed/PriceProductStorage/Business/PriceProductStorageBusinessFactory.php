<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PriceProductStorage\Business;

use Pyz\Zed\PriceProductStorage\Business\Storage\PriceProductAbstractStorageWriter;
use Spryker\Zed\PriceProductStorage\Business\PriceProductStorageBusinessFactory as SprykerPriceProductStorageBusinessFactory;

/**
 * @method \Spryker\Zed\PriceProductStorage\PriceProductStorageConfig getConfig()
 * @method \Spryker\Zed\PriceProductStorage\Persistence\PriceProductStorageQueryContainerInterface getQueryContainer()
 */
class PriceProductStorageBusinessFactory extends SprykerPriceProductStorageBusinessFactory
{
    /**
     * @return \Spryker\Zed\PriceProductStorage\Business\Storage\PriceProductAbstractStorageWriterInterface
     */
    public function createPriceProductAbstractStorageWriter()
    {
        return new PriceProductAbstractStorageWriter(
            $this->getPriceProductFacade(),
            $this->getStoreFacade(),
            $this->getQueryContainer(),
            $this->getConfig()->isSendingToQueue()
        );
    }
}
