<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductBundle\Business;

use Generated\Shared\Transfer\EventEntityTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Event\Business\EventFacadeInterface;
use Spryker\Zed\Product\Dependency\ProductEvents;
use Spryker\Zed\ProductBundle\Business\ProductBundle\ProductBundleWriter as SprykerProductBundleWriter;
use Spryker\Zed\ProductBundle\Business\ProductBundle\Stock\ProductBundleStockWriterInterface;
use Spryker\Zed\ProductBundle\Persistence\ProductBundleQueryContainerInterface;

class ProductBundleWriter extends SprykerProductBundleWriter
{
    /**
     * @var \Spryker\Zed\Event\Business\EventFacadeInterface
     */
    protected $eventFacade;

    /**
     * @param \Spryker\Zed\ProductBundle\Persistence\ProductBundleQueryContainerInterface $productBundleQueryContainer
     * @param \Spryker\Zed\ProductBundle\Business\ProductBundle\Stock\ProductBundleStockWriterInterface $productBundleStockWriter
     * @param \Spryker\Zed\Event\Business\EventFacadeInterface $eventFacade
     */
    public function __construct(
        ProductBundleQueryContainerInterface $productBundleQueryContainer,
        ProductBundleStockWriterInterface $productBundleStockWriter,
        EventFacadeInterface $eventFacade
    ) {
        parent::__construct($productBundleQueryContainer, $productBundleStockWriter);

        $this->eventFacade = $eventFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    public function saveBundledProducts(ProductConcreteTransfer $productConcreteTransfer)
    {
        $productConcreteTransfer = parent::saveBundledProducts($productConcreteTransfer);
        $this->eventFacade->trigger(
            ProductEvents::PRODUCT_CONCRETE_PUBLISH,
            (new EventEntityTransfer())->setId($productConcreteTransfer->getIdProductConcrete())
        );

        return $productConcreteTransfer;
    }
}
