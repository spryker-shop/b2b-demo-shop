<?php



declare(strict_types = 1);

namespace Pyz\Zed\ProductUrlCartConnector\Business;

use Generated\Shared\Transfer\CartChangeTransfer;

interface ProductUrlCartConnectorFacadeInterface
{
    /**
     * Specification:
     * - Reads a persisted abstract product from database.
     * - Expands the items of the CartChangeTransfer with the abstract product's url.
     * - Returns the expanded CartChangeTransfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartChangeTransfer
     */
    public function expandItems(CartChangeTransfer $cartChangeTransfer): CartChangeTransfer;
}
