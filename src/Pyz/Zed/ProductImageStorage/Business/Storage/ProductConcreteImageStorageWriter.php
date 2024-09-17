<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductImageStorage\Business\Storage;

use ArrayObject;
use Generated\Shared\Transfer\ProductImageSetStorageTransfer;
use Generated\Shared\Transfer\ProductImageStorageTransfer;
use Spryker\Zed\ProductImageStorage\Business\Storage\ProductConcreteImageStorageWriter as SprykerProductConcreteImageStorageWriter;

class ProductConcreteImageStorageWriter extends SprykerProductConcreteImageStorageWriter
{
    /**
     * @param array<\Generated\Shared\Transfer\SpyProductImageSetEntityTransfer> $productImageSetEntityTransfers
     *
     * @return \ArrayObject<int, \Generated\Shared\Transfer\ProductImageSetStorageTransfer>
     */
    protected function generateProductImageSetStorageTransfers(array $productImageSetEntityTransfers): ArrayObject
    {
        /** @var \ArrayObject<int, \Generated\Shared\Transfer\ProductImageSetStorageTransfer> $productImageSetStorageTransfers */
        $productImageSetStorageTransfers = new ArrayObject();

        foreach ($productImageSetEntityTransfers as $imageLocalizedSet) {
            $imageSet = (new ProductImageSetStorageTransfer())
                ->setName($imageLocalizedSet->getName());
            foreach ($imageLocalizedSet->getSpyProductImageSetToProductImages() as $imageSetToProductImage) {
                $productImageEntity = $imageSetToProductImage->getSpyProductImage();
                $imageSet->addImage((new ProductImageStorageTransfer())->fromArray($productImageEntity->toArray(), true));
            }
            $productImageSetStorageTransfers[] = $imageSet;
        }

        return $productImageSetStorageTransfers;
    }
}
