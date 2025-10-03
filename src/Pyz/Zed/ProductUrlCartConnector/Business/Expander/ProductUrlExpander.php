<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ProductUrlCartConnector\Business\Expander;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;
use Spryker\Zed\Product\Business\ProductFacadeInterface;

class ProductUrlExpander implements ProductUrlExpanderInterface
{
    protected ProductFacadeInterface $productFacade;

    protected LocaleFacadeInterface $localeFacade;

    public function __construct(
        ProductFacadeInterface $productFacade,
        LocaleFacadeInterface $localeFacade,
    ) {
        $this->productFacade = $productFacade;
        $this->localeFacade = $localeFacade;
    }

    public function expandItems(CartChangeTransfer $cartChangeTransfer): CartChangeTransfer
    {
        foreach ($cartChangeTransfer->getItems() as $itemTransfer) {
            $this->expandItemsWithUrl($itemTransfer);
        }

        return $cartChangeTransfer;
    }

    protected function expandItemsWithUrl(ItemTransfer $itemTransfer): void
    {
        $idLocale = $this->localeFacade->getCurrentLocale()->getIdLocale();
        $productAbstractTransfer = new ProductAbstractTransfer();
        $productAbstractTransfer
            ->setSku($itemTransfer->getAbstractSku())
            ->setIdProductAbstract($itemTransfer->getIdProductAbstract());
        $productUrlTransfer = $this->productFacade->getProductUrl($productAbstractTransfer);
        foreach ($productUrlTransfer->getUrls() as $localizedUrlTransfer) {
            if ($localizedUrlTransfer->getLocale() === null || $localizedUrlTransfer->getLocale()->getIdLocale() !== $idLocale) {
                continue;
            }

            $itemTransfer->setUrl($localizedUrlTransfer->getUrl());
        }
    }
}
