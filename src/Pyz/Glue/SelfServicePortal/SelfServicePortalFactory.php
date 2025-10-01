<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Glue\SelfServicePortal;

use Pyz\Glue\SelfServicePortal\Processor\BackendApi\Mapper\SspAssetsMapper as BackendSspAssetsMapper;
use Pyz\Glue\SelfServicePortal\Processor\BackendApi\Creator\SspAssetsCreator as BackendSspAssetsCreator;
use SprykerFeature\Glue\SelfServicePortal\Processor\BackendApi\Creator\SspAssetsCreatorInterface as BackendSspAssetsCreatorInterface;
use SprykerFeature\Glue\SelfServicePortal\Processor\BackendApi\Mapper\SspAssetsMapperInterface as BackendSspAssetsMapperInterface;
use SprykerFeature\Glue\SelfServicePortal\SelfServicePortalFactory as SprykerSelfServicePortalFactory;

/**
 * @method \SprykerFeature\Client\SelfServicePortal\SelfServicePortalClientInterface getClient()
 */
class SelfServicePortalFactory extends SprykerSelfServicePortalFactory
{
    public function createSspAssetsMapper(): BackendSspAssetsMapperInterface
    {
        return new BackendSspAssetsMapper($this->getSelfServicePortalFacade());
    }

    public function createSspAssetsCreator(): BackendSspAssetsCreatorInterface
    {
        return new BackendSspAssetsCreator(
            $this->getSelfServicePortalFacade(),
            $this->createSspAssetsResponseBuilder(),
            $this->createSspAssetsMapper(),
        );
    }
}
