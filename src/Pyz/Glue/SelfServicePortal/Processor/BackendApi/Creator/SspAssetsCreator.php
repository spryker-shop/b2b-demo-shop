<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Glue\SelfServicePortal\Processor\BackendApi\Creator;

use Generated\Shared\Transfer\ErrorTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use SprykerFeature\Glue\SelfServicePortal\Processor\BackendApi\Builder\SspAssetsResponseBuilderInterface;
use SprykerFeature\Glue\SelfServicePortal\Processor\BackendApi\Mapper\SspAssetsMapperInterface;
use SprykerFeature\Zed\SelfServicePortal\Business\SelfServicePortalFacadeInterface;
use SprykerFeature\Glue\SelfServicePortal\Processor\BackendApi\Creator\SspAssetsCreator as SprykerSspAssetsCreator;

class SspAssetsCreator extends SprykerSspAssetsCreator
{
    public function __construct(
        protected SelfServicePortalFacadeInterface $selfServicePortalFacade,
        protected SspAssetsResponseBuilderInterface $sspAssetsResponseBuilder,
        protected SspAssetsMapperInterface $sspAssetsMapper
    ) {
    }

    public function createSspAsset(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $sspAssetCollectionRequestTransfer = $this->sspAssetsMapper->mapGlueRequestToSspAssetCollectionRequestTransferForCreate($glueRequestTransfer);
        $sspAssetCollectionResponseTransfer = $this->selfServicePortalFacade->createSspAssetCollection($sspAssetCollectionRequestTransfer);

        $sspAssetCollectionResponseTransfer->addError((new ErrorTransfer())->setMessage('Some custom error'));

        if ($sspAssetCollectionResponseTransfer->getErrors()->count() > 0) {
            return $this->sspAssetsResponseBuilder->createErrorResponseFromAssetCollectionResponse($sspAssetCollectionResponseTransfer, 'en_US');
        }

        $sspAssetTransfer = $sspAssetCollectionResponseTransfer->getSspAssets()->getIterator()->current();

        return $this->sspAssetsResponseBuilder->createSspAssetResponse($sspAssetTransfer, $glueRequestTransfer);
    }
}
