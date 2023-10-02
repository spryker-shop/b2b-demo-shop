<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\ProductDetailPage\Controller;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use SprykerShop\Yves\ProductDetailPage\Controller\ProductController as SprykerShopProductController;
use SprykerShop\Yves\ProductDetailPage\Exception\ProductAccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method \Spryker\Client\Product\ProductClientInterface getClient()
 * @method \Pyz\Yves\ProductDetailPage\ProductDetailPageFactory getFactory()
 */
class ProductController extends SprykerShopProductController
{
    /**
     * @var string
     */
    protected const KEY_ID_PRODUCT_ABSTRACT = 'id_product_abstract';

    /**
     * @param array<mixed> $productData
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return array<string, mixed>
     */
    protected function executeDetailAction(array $productData, Request $request): array
    {
        $selectedAttributes = $this->getSelectedAttributesWithoutPostfix($productData, $request);

        $productViewTransfer = $this->getFactory()
            ->getProductStoragePyzClient()
            ->mapProductStorageData($productData, $this->getLocale(), $selectedAttributes);

        try {
            $this->assertProductRestrictions($productViewTransfer);
        } catch (ProductAccessDeniedException $productAccessDeniedException) {
            throw new NotFoundHttpException();
        }

        $quoteTransfer = new QuoteTransfer();
        $quoteTransfer->addItem(
            (new ItemTransfer())->setIdProductAbstract($productViewTransfer->getIdProductAbstract()),
        );

        $bundledProducts = [];
        foreach ($productViewTransfer->getBundledProductIds() as $productId => $quantity) {
            $bundledProduct = $this->getFactory()->getProductStoragePyzClient()->findProductConcreteStorageData($productId, $this->getLocale());
            $bundledProduct['idProductAbstract'] = $bundledProduct['id_product_abstract'];
            $bundledProduct['productUrl'] = $bundledProduct['url'];
            $bundledProduct['quantity'] = $quantity;
            $bundledProductView = $this->getFactory()->getProductStoragePyzClient()->mapProductStorageData(
                [
                    'idProductAbstract' => $bundledProduct['id_product_abstract'],
                    'attribute_map' => [
                        'product_concrete_ids' => [],
                        ],
                    'sku' => $bundledProduct['sku'],
                    'idProductConcrete' => $bundledProduct['id_product_concrete'],
                ],
                $this->getLocale(),
            );
            $bundledProduct['image'] = $bundledProductView->getImages()->offsetGet(0)->getExternalUrlSmall();
            $bundledProducts[] = $bundledProduct;
        }

        return [
            'cart' => $quoteTransfer,
            'product' => $productViewTransfer,
            'productUrl' => $this->getProductUrl($productViewTransfer),
            'bundledProducts' => $bundledProducts,
        ];
    }
}
