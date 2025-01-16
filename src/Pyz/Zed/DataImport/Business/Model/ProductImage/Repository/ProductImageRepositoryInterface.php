<?php



declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\ProductImage\Repository;

use Orm\Zed\ProductImage\Persistence\SpyProductImage;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSet;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImage;

interface ProductImageRepositoryInterface
{
    /**
     * @param string $name
     * @param int $localeId
     * @param int|null $productAbstractId
     * @param int|null $productConcreteId
     * @param string|null $productImageSetKey
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSet
     */
    public function getProductImageSetEntity(
        string $name,
        int $localeId,
        ?int $productAbstractId = null,
        ?int $productConcreteId = null,
        ?string $productImageSetKey = null,
    ): SpyProductImageSet;

    /**
     * @param string $productImageKey
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImage
     */
    public function getProductImageEntity(string $productImageKey): SpyProductImage;

    /**
     * @param int $productImageSetId
     * @param int $productImageId
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImage
     */
    public function getProductImageSetToProductImageRelationEntity(
        int $productImageSetId,
        int $productImageId,
    ): SpyProductImageSetToProductImage;
}
