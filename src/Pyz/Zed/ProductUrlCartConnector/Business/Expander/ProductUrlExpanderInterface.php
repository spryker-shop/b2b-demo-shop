<?php



declare(strict_types = 1);

namespace Pyz\Zed\ProductUrlCartConnector\Business\Expander;

use Generated\Shared\Transfer\CartChangeTransfer;

interface ProductUrlExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartChangeTransfer
     */
    public function expandItems(CartChangeTransfer $cartChangeTransfer): CartChangeTransfer;
}
