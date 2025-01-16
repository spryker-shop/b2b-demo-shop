<?php



declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\CombinedProduct\Product;

use Pyz\Zed\DataImport\Business\Model\Product\AttributesExtractorStep;

class CombinedAttributesExtractorStep extends AttributesExtractorStep
{
    /**
     * @return string
     */
    protected function getAttributeKeyPrefix(): string
    {
        return 'product.attribute_key_';
    }

    /**
     * @return string
     */
    protected function getAttributeValuePrefix(): string
    {
        return 'product.value_';
    }
}
