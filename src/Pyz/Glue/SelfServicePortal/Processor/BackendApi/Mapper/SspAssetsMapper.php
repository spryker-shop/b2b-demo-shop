<?php

namespace Pyz\Glue\SelfServicePortal\Processor\BackendApi\Mapper;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\SspAssetCollectionRequestTransfer;
use Generated\Shared\Transfer\SspAssetConditionsTransfer;
use Generated\Shared\Transfer\SspAssetCriteriaTransfer;
use Generated\Shared\Transfer\SspAssetTransfer;
use SprykerFeature\Glue\SelfServicePortal\Processor\BackendApi\Mapper\SspAssetsMapper as SprykerSspAssetMapper;
use SprykerFeature\Client\SelfServicePortal\SelfServicePortalClientInterface;

class SspAssetsMapper extends SprykerSspAssetMapper
{
    public function __construct(protected SelfServicePortalClientInterface $selfServicePortalClient)
    {
    }

    public function mapGlueRequestToSspAssetCollectionRequestTransferForUpdate(GlueRequestTransfer $glueRequestTransfer): SspAssetCollectionRequestTransfer
    {
        /** @var \Generated\Shared\Transfer\SspAssetsBackendApiAttributesTransfer $sspAssetsBackendApiAttributesTransfer */
        $sspAssetsBackendApiAttributesTransfer = $glueRequestTransfer->getResourceOrFail()->getAttributes();

        $sspAssetTransfer = $this->findSspAssetByReference($glueRequestTransfer->getResourceOrFail()->getId());

        if (!$sspAssetTransfer) {
            return (new SspAssetCollectionRequestTransfer());
        }

        $sspAssetTransfer
            ->setName($sspAssetsBackendApiAttributesTransfer->getName())
            ->setSerialNumber($sspAssetsBackendApiAttributesTransfer->getSerialNumber())
            ->setNote($sspAssetsBackendApiAttributesTransfer->getNote())
            ->setExternalImageUrl($sspAssetsBackendApiAttributesTransfer->getExternalImageUrl());

        return (new SspAssetCollectionRequestTransfer())->addSspAsset($sspAssetTransfer);
    }

    protected function findSspAssetByReference(string $assetReference): ?SspAssetTransfer
    {
        $sspAssetCollectionTransfer = $this->selfServicePortalClient->getSspAssetCollection(
            (new SspAssetCriteriaTransfer())->setSspAssetConditions(
                (new SspAssetConditionsTransfer())->setReferences([$assetReference])
            )
        );

        if ($sspAssetCollectionTransfer->getSspAssets()->count() === 0) {
            return null;
        }

        return $sspAssetCollectionTransfer->getSspAssets()->getIterator()->current();
    }
}
