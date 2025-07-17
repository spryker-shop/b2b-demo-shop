<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\SelfServicePortal\Service\Checker;

use Generated\Shared\Transfer\ItemTransfer;
use SprykerFeature\Yves\SelfServicePortal\SelfServicePortalConfig;
use SprykerFeature\Yves\SelfServicePortal\Service\Checker\AddressFormChecker as SprykerAddressFormChecker;

class AddressFormChecker extends SprykerAddressFormChecker
{
    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return bool
     */
    public function isApplicableForSingleAddressPerShipmentType(
        ItemTransfer $itemTransfer,
    ): bool {
        if ($itemTransfer->getRelatedBundleItemIdentifier() || $itemTransfer->getBundleItemIdentifier()) {
            return false;
        }

        $shipmentTypeKey = $itemTransfer->getShipmentType()?->getKey() ?? SelfServicePortalConfig::SHIPMENT_TYPE_DELIVERY;
        if (!$shipmentTypeKey) {
            return false;
        }

        if (!$this->isApplicableShipmentType($shipmentTypeKey)) {
            return false;
        }

        $isFieldAlreadySet = $itemTransfer->getIsSingleAddressPerShipmentType();
        if ($isFieldAlreadySet) {
            $this->addProcessedShipmentType($shipmentTypeKey);

            return true;
        }

        if (static::hasSingleAddressFieldAlreadyAddedForShipmentType($shipmentTypeKey)) {
            return false;
        }

        $this->addProcessedShipmentType($shipmentTypeKey);

        return true;
    }
}
