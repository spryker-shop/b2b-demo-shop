<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\SelfServicePortal\Widget;

use Generated\Shared\Transfer\CompanyUserTransfer;
use SprykerFeature\Yves\SelfServicePortal\Widget\SspItemAssetSelectorWidget as SprykerFeatureSspItemAssetSelectorWidget;

class SspItemAssetSelectorWidget extends SprykerFeatureSspItemAssetSelectorWidget
{
    protected function addAssetParameter(CompanyUserTransfer $companyUserTransfer): void
    {
        $request = $this->getFactory()->getRequestStack()->getCurrentRequest();

        if (!$request) {
            return;
        }

        /** @var string|null $assetReference */
        $assetReference = $request->query->get(static::PARAMETER_SSP_ASSET_REFERENCE);

        if (!$assetReference) {
            $this->addParameter(static::PARAMETER_ASSET, null);

            return;
        }

        $sspAssetStorageTransfer = $this->getFactory()->createSspAssetStorageReader()->findSspAssetStorageByReference($companyUserTransfer, $assetReference);
        $sspAssetStorageTransfer->setReference($assetReference);
        $this->addParameter(static::PARAMETER_ASSET, $sspAssetStorageTransfer);
    }
}
