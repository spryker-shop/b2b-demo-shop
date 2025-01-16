<?php



declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\CombinedProduct\ProductImage\Writer;

use Pyz\Zed\DataImport\Business\Model\ProductImage\Repository\ProductImageRepositoryInterface;
use Pyz\Zed\DataImport\Business\Model\ProductImage\Writer\ProductImagePropelDataSetWriter;

class CombinedProductImagePropelDataSetWriter extends ProductImagePropelDataSetWriter
{
    /**
     * @param \Pyz\Zed\DataImport\Business\Model\ProductImage\Repository\ProductImageRepositoryInterface $productImageRepository
     */
    public function __construct(ProductImageRepositoryInterface $productImageRepository)
    {
        parent::__construct($productImageRepository);
    }
}
