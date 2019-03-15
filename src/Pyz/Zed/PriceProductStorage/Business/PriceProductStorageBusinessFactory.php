<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
