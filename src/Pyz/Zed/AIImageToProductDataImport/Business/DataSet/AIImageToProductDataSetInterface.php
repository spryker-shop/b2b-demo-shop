<?php

namespace Pyz\Zed\AIImageToProductDataImport\Business\DataSet;

interface AIImageToProductDataSetInterface
{
    /**
     * @var string
     */
    public const COLUMN_SKU = 'sku';

    /**
     * @var string
     */
    public const COLUMN_PRICE = 'price';

    /**
     * @var string
     */
    public const COLUMN_STOCK = 'stock';

    /**
     * @var string
     */
    public const COLUMN_TAX_SET = 'tax_set';

    /**
     * @var string
     */
    public const COLUMN_IMAGE_URL = 'image_url';
}
