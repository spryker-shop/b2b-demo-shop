<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ProductSetWidget\Widget;

use Generated\Shared\Transfer\ProductSetDataStorageTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;
use SprykerShop\Yves\ProductSetWidget\Plugin\CmsContentWidgetProductSetConnector\ProductSetWidgetPlugin;

/**
 * @method \Pyz\Yves\ProductSetWidget\ProductSetWidgetFactory getFactory()
 */
class ProductSetIdsWidget extends AbstractWidget
{
    /**
     * @param array $productSetIds
     */
    public function __construct(array $productSetIds)
    {
        $this->addWidget(ProductSetWidgetPlugin::class);

        $productSetList = $this->getProductSetList($productSetIds);
        $this->addParameter('productSetList', $productSetList);
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'ProductSetIdsWidget';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@ProductSetWidget/views/product-set-ids/product-set-ids.twig';
    }

    /**
     * @param int[] $productSetIds
     *
     * @return array
     */
    protected function getProductSetList(array $productSetIds): array
    {
        $productSets = [];
        foreach ($productSetIds as $productSetId) {
            $productSet = $this->getSingleProductSet($productSetId);
            if (!isset($productSet['productSet'])) {
                continue;
            }
            $productSets[] = $productSet;
        }

        return $productSets;
    }

    /**
     * @param int $productSetId
     *
     * @return array
     */
    protected function getSingleProductSet($productSetId): array
    {
        $productSet = $this->getProductSetStorageTransfer($productSetId);
        if (!$productSet || !$productSet->getIsActive()) {
            return [];
        }

        return [
            'productSet' => $productSet,
            'productViews' => $this->mapProductSetDataStorageTransfers($productSet),
        ];
    }

    /**
     * @param int $idProductSet
     *
     * @return \Generated\Shared\Transfer\ProductSetDataStorageTransfer|null
     */
    protected function getProductSetStorageTransfer($idProductSet): ?ProductSetDataStorageTransfer
    {
        return $this->getFactory()->getProductSetStorageClient()->getProductSetByIdProductSet($idProductSet, $this->getLocale());
    }

    /**
     * @param \Generated\Shared\Transfer\ProductSetDataStorageTransfer $productSetDataStorageTransfer
     *
     * @return \Generated\Shared\Transfer\ProductViewTransfer[]
     */
    protected function mapProductSetDataStorageTransfers(ProductSetDataStorageTransfer $productSetDataStorageTransfer): array
    {
        $productViewTransfers = [];
        foreach ($productSetDataStorageTransfer->getProductAbstractIds() as $idProductAbstract) {
            $productAbstractData = $this->getFactory()->getProductStorageClient()->findProductAbstractStorageData($idProductAbstract, $this->getLocale());
            if ($productAbstractData === null) {
                continue;
            }
            $productViewTransfers[] = $this->getFactory()->getProductStorageClient()->mapProductStorageData(
                $productAbstractData,
                $this->getLocale()
            );
        }

        return $productViewTransfers;
    }
}
