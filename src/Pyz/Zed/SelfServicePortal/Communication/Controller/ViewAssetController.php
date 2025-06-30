<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\SelfServicePortal\Communication\Controller;

use Generated\Shared\Transfer\SspAssetTransfer;
use Spryker\Service\UtilText\Model\Url\Url;
use Symfony\Component\HttpFoundation\Request;
use SprykerFeature\Zed\SelfServicePortal\Communication\Controller\ViewAssetController as SprykerViewAssetController;

/**
 * @method \SprykerFeature\Zed\SelfServicePortal\Communication\SelfServicePortalCommunicationFactory getFactory()
 * @method \SprykerFeature\Zed\SelfServicePortal\Business\SelfServicePortalFacadeInterface getFacade()
 * @method \SprykerFeature\Zed\SelfServicePortal\Persistence\SelfServicePortalRepositoryInterface getRepository()
 */
class ViewAssetController extends SprykerViewAssetController
{
    /**
     * @var string
     */
    protected const PARAM_ID_SSP_ASSET = 'id-ssp-asset';

    /**
     * @var string
     */
    protected const MESSAGE_SSP_ASSET_NOT_FOUND = 'Asset not found.';

    /**
     * @uses \SprykerFeature\Zed\SelfServicePortal\Communication\Controller\ListAssetController::indexAction()
     *
     * @var string
     */
    protected const ROUTE_SSP_ASSET_LIST = '/self-service-portal/list-asset';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array<string, mixed>
     */
    public function indexAction(Request $request)
    {
        $idSspAsset = $this->castId($request->query->get(static::PARAM_ID_SSP_ASSET));

        $sspAssetTransfer = $this->getFactory()->createSspAssetFormDataProvider()->getData($idSspAsset);

        if ($sspAssetTransfer === null) {
            $this->addErrorMessage(static::MESSAGE_SSP_ASSET_NOT_FOUND);

            return $this->redirectResponse(static::ROUTE_SSP_ASSET_LIST);
        }

        return [
            'sspAsset' => $sspAssetTransfer,
            'sspAssetTabs' => $this->getFactory()->createSspAssetTabs()->createView(),
            'imageUrl' => $this->getAssetImageUrl($sspAssetTransfer),
            'status' => $this->getFactory()->getConfig()->getAssetStatuses()[$sspAssetTransfer->getStatus()] ?? null,
        ];
    }

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
