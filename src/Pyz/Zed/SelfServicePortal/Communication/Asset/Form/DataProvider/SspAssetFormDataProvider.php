<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\SelfServicePortal\Communication\Asset\Form\DataProvider;

use Generated\Shared\Transfer\SspAssetTransfer;
use Spryker\Service\UtilText\Model\Url\Url;
use SprykerFeature\Zed\SelfServicePortal\Communication\Asset\Form\DataProvider\SspAssetFormDataProvider as SprykerSspAssetFormDataProvider;

class SspAssetFormDataProvider extends SprykerSspAssetFormDataProvider
{

    /**
     * @param \Generated\Shared\Transfer\SspAssetTransfer $sspAssetTransfer
     *
     * @return string|null
     */
    public function getAssetImageUrl(SspAssetTransfer $sspAssetTransfer): ?string
    {
        if (!$sspAssetTransfer->getImage()) {
            return null;
        }

        return Url::generate('asset-image', ['ssp-asset-reference' => $sspAssetTransfer->getReferenceOrFail()])->build();
    }
}
