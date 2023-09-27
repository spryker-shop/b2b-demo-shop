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
    protected const REQUEST = 'request';

    /**
     * @var string
     */
    protected const PARAMETER_PRODUCT_SET_LIST = 'productSetList';

    /**
     * @var string
     */
    protected const PARAMETER_ATTRIBUTES = 'attributes';

    /**
     * @param list<int> $productSetIds
     */
    public function __construct(array $productSetIds)
    {
        $this->addWidget(ProductSetWidgetPlugin::class);

        $this->addProductSetListParameter($productSetIds);
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
     * @param list<int> $productSetIds
     *
     * @return void
     */
    protected function addProductSetListParameter(array $productSetIds): void
    {
        $productSetList = $this->getProductSetList($productSetIds);

        $this->addParameter(static::PARAMETER_PRODUCT_SET_LIST, $productSetList);
    }

    /**
     * @param list<int> $productSetIds
     *
     * @return array<int, array<string, mixed>>
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
     * @return array<string, mixed>
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
     * @return array<\Generated\Shared\Transfer\ProductViewTransfer>
     */
    protected function mapProductSetDataStorageTransfers(ProductSetDataStorageTransfer $productSetDataStorageTransfer): array
    {
        $productViewTransfers = [];
        foreach ($productSetDataStorageTransfer->getProductAbstractIds() as $idProductAbstract) {
            $productAbstractData = $this->getFactory()->getProductStorageClient()->findProductAbstractStorageData($idProductAbstract, $this->getLocale());
            if ($productAbstractData === null) {
                continue;
            }
            $productViewTransfers[] = $this->getFactory()
                ->getProductStorageClient()
                ->mapProductStorageData($productAbstractData, $this->getLocale())
                ->setSelectedAttributes($this->getSelectedAttributes($idProductAbstract));
        }

        return $productViewTransfers;
    }

    /**
     * @param int $idProductAbstract
     *
     * @return array<int, mixed>
     */
    protected function getSelectedAttributes(int $idProductAbstract): array
    {
        /** @var array<mixed> $attributes */
        $attributes = $this->getRequest()->query->get(static::PARAMETER_ATTRIBUTES) ?: [];

        return isset($attributes[$idProductAbstract]) ? array_reverse(array_filter($attributes[$idProductAbstract])) : [];
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    protected function getRequest(): Request
    {
        return $this->getGlobalContainer()->get(static::REQUEST);
    }
}
