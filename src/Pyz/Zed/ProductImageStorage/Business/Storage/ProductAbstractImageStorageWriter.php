<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductImageStorage\Business\Storage;

use ArrayObject;
use Generated\Shared\Transfer\ProductImageSetStorageTransfer;
use Generated\Shared\Transfer\ProductImageStorageTransfer;
use Spryker\Zed\ProductImageStorage\Business\Storage\ProductAbstractImageStorageWriter as SprykerProductAbstractImageStorageWriter;

class ProductAbstractImageStorageWriter extends SprykerProductAbstractImageStorageWriter
{
    /**
     * @param array<\Generated\Shared\Transfer\SpyProductImageSetEntityTransfer> $productImageSetEntityTransfers
     *
     * @return \ArrayObject<int, \Generated\Shared\Transfer\ProductImageSetStorageTransfer>
     */
    protected function generateProductAbstractImageSets(array $productImageSetEntityTransfers): ArrayObject
    {
        /** @var \ArrayObject<int, \Generated\Shared\Transfer\ProductImageSetStorageTransfer> $productImageSetStorageTransfers */
        $productImageSetStorageTransfers = new ArrayObject();

        foreach ($productImageSetEntityTransfers as $productImageSetEntityTransfer) {
            $imageSet = (new ProductImageSetStorageTransfer())
                ->setName($productImageSetEntityTransfer->getName());
            foreach ($productImageSetEntityTransfer->getSpyProductImageSetToProductImages() as $productImageSetToProductImageTransfer) {
                $productImageEntity = $productImageSetToProductImageTransfer->getSpyProductImage();
                $imageSet->addImage((new ProductImageStorageTransfer())->fromArray($productImageEntity->toArray(), true));
            }
            $productImageSetStorageTransfers[] = $imageSet;
        }

        return $productImageSetStorageTransfers;
    }
}
