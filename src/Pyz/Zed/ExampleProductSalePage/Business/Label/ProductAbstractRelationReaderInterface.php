<?php



declare(strict_types = 1);

namespace Pyz\Zed\ExampleProductSalePage\Business\Label;

interface ProductAbstractRelationReaderInterface
{
    /**
     * @return array<\Generated\Shared\Transfer\ProductLabelProductAbstractRelationsTransfer>
     */
    public function findProductLabelProductAbstractRelationChanges(): array;
}
