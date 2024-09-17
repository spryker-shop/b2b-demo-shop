<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductImageStorage\Business;

use Pyz\Zed\ProductImageStorage\Business\Storage\ProductAbstractImageStorageWriter;
use Pyz\Zed\ProductImageStorage\Business\Storage\ProductConcreteImageStorageWriter;
use Spryker\Zed\ProductImageStorage\Business\ProductImageStorageBusinessFactory as SprykerProductImageStorageBusinessFactory;
use Spryker\Zed\ProductImageStorage\Business\Storage\ProductAbstractImageStorageWriterInterface;
use Spryker\Zed\ProductImageStorage\Business\Storage\ProductConcreteImageStorageWriterInterface;

/**
 * @method \Spryker\Zed\ProductImageStorage\Persistence\ProductImageStorageEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\ProductImageStorage\ProductImageStorageConfig getConfig()
 * @method \Spryker\Zed\ProductImageStorage\Persistence\ProductImageStorageRepositoryInterface getRepository()
 */
class ProductImageStorageBusinessFactory extends SprykerProductImageStorageBusinessFactory
{
    /**
     * @return \Spryker\Zed\ProductImageStorage\Business\Storage\ProductAbstractImageStorageWriterInterface
     */
    public function createProductAbstractImageWriter(): ProductAbstractImageStorageWriterInterface
    {
        return new ProductAbstractImageStorageWriter(
            $this->getProductImageFacade(),
            $this->getQueryContainer(),
            $this->getRepository(),
            $this->getEntityManager(),
            $this->getEventBehaviorFacade(),
            $this->getConfig()->isSendingToQueue(),
        );
    }

    /**
     * @return \Spryker\Zed\ProductImageStorage\Business\Storage\ProductConcreteImageStorageWriterInterface
     */
    public function createProductConcreteImageWriter(): ProductConcreteImageStorageWriterInterface
    {
        return new ProductConcreteImageStorageWriter(
            $this->getProductImageFacade(),
            $this->getQueryContainer(),
            $this->getRepository(),
            $this->getConfig()->isSendingToQueue(),
        );
    }
}
