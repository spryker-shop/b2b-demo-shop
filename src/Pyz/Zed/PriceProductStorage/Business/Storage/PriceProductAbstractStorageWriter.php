<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PriceProductStorage\Business\Storage;

use Spryker\Zed\PriceProductStorage\Business\Storage\PriceProductAbstractStorageWriter as SprykerPriceProductAbstractStorageWriter;

class PriceProductAbstractStorageWriter extends SprykerPriceProductAbstractStorageWriter
{
    /**
     * @param int[] $productAbstractIds
     *
     * @return array
     */
    protected function getProductAbstractPriceGroups(array $productAbstractIds)
    {
        $priceGroups = [];
        $priceGroupsCollection = [];
        $priceProductCriteriaTransfer = $this->getPriceCriteriaTransfer();
        $productAbstractPriceProductTransfers = $this->priceProductFacade->findProductAbstractPricesWithoutPriceExtractionByProductAbstractIdsAndCriteria($productAbstractIds, $priceProductCriteriaTransfer);

        foreach ($productAbstractPriceProductTransfers as $key => $priceProductTransfer) {
            $idProductAbstract = $priceProductTransfer->getIdProductAbstract();
            $storeName = $this->getStoreNameById($priceProductTransfer->getMoneyValue()->getFkStore());
            $priceGroups[$idProductAbstract][$storeName][] = $priceProductTransfer;
        }

        foreach ($productAbstractIds as $idProductAbstract) {
            if (!isset($priceGroups[$idProductAbstract])) {
                continue;
            }
            $priceGroupsCollection[$idProductAbstract] = $this->getProductAbstractPriceStoreGroups($priceGroups[$idProductAbstract], $idProductAbstract);
        }

        return $priceGroupsCollection;
    }
}
