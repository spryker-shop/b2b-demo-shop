<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

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
