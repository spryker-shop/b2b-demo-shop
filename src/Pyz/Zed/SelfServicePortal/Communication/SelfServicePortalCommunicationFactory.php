<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\SelfServicePortal\Communication;

use Pyz\Zed\SelfServicePortal\Communication\Asset\Form\DataProvider\SspAssetFormDataProvider;
use SprykerFeature\Zed\SelfServicePortal\Communication\SelfServicePortalCommunicationFactory as SprykerSelfServicePortalCommunicationFactory;

/**
 * @method \Pyz\Zed\SelfServicePortal\SelfServicePortalConfig getConfig()
 * @method \SprykerFeature\Zed\SelfServicePortal\Business\SelfServicePortalFacadeInterface getFacade()
 * @method \SprykerFeature\Zed\SelfServicePortal\Persistence\SelfServicePortalEntityManagerInterface getEntityManager()
 * @method \SprykerFeature\Zed\SelfServicePortal\Persistence\SelfServicePortalRepositoryInterface getRepository()
 */
class SelfServicePortalCommunicationFactory extends SprykerSelfServicePortalCommunicationFactory
{
    public function createSspAssetFormDataProvider(): SspAssetFormDataProvider
    {
        return new SspAssetFormDataProvider(
            $this->getFacade(),
            $this->getConfig(),
            $this->getCompanyBusinessUnitFacade(),
            $this->getCompanyFacade(),
        );
    }
}
