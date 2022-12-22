<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ProductSetWidget\Widget;

use Generated\Shared\Transfer\ProductSetDataStorageTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;
use SprykerShop\Yves\ProductSetWidget\Plugin\CmsContentWidgetProductSetConnector\ProductSetWidgetPlugin;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Yves\ProductSetWidget\ProductSetWidgetFactory getFactory()
 */
class ProductSetIdsWidget extends AbstractWidget
{
    /**
     * @var string
     */
    protected const PYZ_REQUEST = 'request';

    /**
     * @var string
     */
    protected const PYZ_PARAMETER_PRODUCT_SET_LIST = 'productSetList';

    /**
     * @var string
     */
    protected const PYZ_PARAMETER_ATTRIBUTES = 'attributes';

    /**
     * @param array $productSetIds
     */
    public function __construct(array $productSetIds)
    {
        $this->addWidget(ProductSetWidgetPlugin::class);

        $this->addPyzProductSetListParameter($productSetIds);
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
     * @param array $productSetIds
     *
     * @return void
     */
    protected function addPyzProductSetListParameter(array $productSetIds): void
    {
        $productSetList = $this->getPyzProductSetList($productSetIds);

        $this->addParameter(static::PYZ_PARAMETER_PRODUCT_SET_LIST, $productSetList);
    }

    /**
     * @param array<int> $productSetIds
     *
     * @return array
     */
    protected function getPyzProductSetList(array $productSetIds): array
    {
        $productSets = [];
        foreach ($productSetIds as $productSetId) {
            $productSet = $this->getPyzSingleProductSet($productSetId);
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
    protected function getPyzSingleProductSet($productSetId): array
    {
        $productSet = $this->getPyzProductSetStorageTransfer($productSetId);
        if (!$productSet || !$productSet->getIsActive()) {
            return [];
        }

        return [
            'productSet' => $productSet,
            'productViews' => $this->mapPyzProductSetDataStorageTransfers($productSet),
        ];
    }

    /**
     * @param int $idProductSet
     *
     * @return \Generated\Shared\Transfer\ProductSetDataStorageTransfer|null
     */
    protected function getPyzProductSetStorageTransfer($idProductSet): ?ProductSetDataStorageTransfer
    {
        return $this->getFactory()->getPyzProductSetStorageClient()->getProductSetByIdProductSet($idProductSet, $this->getLocale());
    }

    /**
     * @param \Generated\Shared\Transfer\ProductSetDataStorageTransfer $productSetDataStorageTransfer
     *
     * @return array<\Generated\Shared\Transfer\ProductViewTransfer>
     */
    protected function mapPyzProductSetDataStorageTransfers(ProductSetDataStorageTransfer $productSetDataStorageTransfer): array
    {
        $productViewTransfers = [];
        foreach ($productSetDataStorageTransfer->getProductAbstractIds() as $idProductAbstract) {
            $productAbstractData = $this->getFactory()->getPyzProductStorageClient()->findProductAbstractStorageData($idProductAbstract, $this->getLocale());
            if ($productAbstractData === null) {
                continue;
            }
            $productViewTransfers[] = $this->getFactory()
                ->getPyzProductStorageClient()
                ->mapProductStorageData($productAbstractData, $this->getLocale())
                ->setSelectedAttributes($this->getPyzSelectedAttributes($idProductAbstract));
        }

        return $productViewTransfers;
    }

    /**
     * @param int $idProductAbstract
     *
     * @return array<int, mixed>
     */
    protected function getPyzSelectedAttributes(int $idProductAbstract): array
    {
        /** @var array $attributes */
        $attributes = $this->getPyzRequest()->query->get(static::PYZ_PARAMETER_ATTRIBUTES) ?: [];

        return isset($attributes[$idProductAbstract]) ? array_reverse(array_filter($attributes[$idProductAbstract])) : [];
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    protected function getPyzRequest(): Request
    {
        return $this->getGlobalContainer()->get(static::PYZ_REQUEST);
    }
}
