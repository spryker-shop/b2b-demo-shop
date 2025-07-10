<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ClickAndCollectExample\Communication\Plugin\Cart;

use Generated\Shared\Transfer\CartChangeTransfer;
use Spryker\Zed\CartExtension\Dependency\Plugin\ItemExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\ClickAndCollectExample\ClickAndCollectExampleConfig getConfig()
 * @method \Spryker\Zed\ClickAndCollectExample\Business\ClickAndCollectExampleFacadeInterface getFacade()
 * @method \Spryker\Zed\ClickAndCollectExample\Communication\ClickAndCollectExampleCommunicationFactory getFactory()
 */
class ClickAndCollectMerchantReferenceItemExpanderPlugin extends AbstractPlugin implements ItemExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     * - Sets merchant reference for items that have product offer reference and pickup shipment type.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartChangeTransfer
     */
    public function expandItems(CartChangeTransfer $cartChangeTransfer): CartChangeTransfer
    {
        $pickupShipmentTypeKey = $this->getConfig()->getPickupShipmentTypeKey();

        foreach ($cartChangeTransfer->getItems() as $itemTransfer) {
            if (!$itemTransfer->getProductOfferReference()) {
                continue;
            }

            if (!$itemTransfer->getShipmentType() || $itemTransfer->getShipmentType()->getKey() !== $pickupShipmentTypeKey) {
                continue;
            }

            $itemTransfer->setMerchantReference($this->getConfig()->getMerchantReference());
        }

        return $cartChangeTransfer;
    }
}
