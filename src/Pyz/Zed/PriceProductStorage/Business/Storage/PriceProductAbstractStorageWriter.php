<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
