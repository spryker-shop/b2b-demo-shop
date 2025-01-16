<?php



declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\CombinedProduct\ProductAbstractStore;

use Pyz\Zed\DataImport\Business\Model\ProductAbstractStore\ProductAbstractStoreHydratorStep;

class CombinedProductAbstractStoreHydratorStep extends ProductAbstractStoreHydratorStep
{
    /**
     * @var int
     */
    public const BULK_SIZE = 5000;

    /**
     * @var string
     */
    public const COLUMN_ABSTRACT_SKU = 'abstract_sku';

    /**
     * @var string
     */
    public const COLUMN_STORE_NAME = 'product_abstract_store.store_name';
}
