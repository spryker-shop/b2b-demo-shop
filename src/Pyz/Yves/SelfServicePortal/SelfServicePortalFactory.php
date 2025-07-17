<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\SelfServicePortal;

use Pyz\Yves\SelfServicePortal\Service\Checker\AddressFormChecker;
use Pyz\Yves\SelfServicePortal\Service\Handler\SingleAddressPerShipmentTypePreSubmitHandler;
use SprykerFeature\Yves\SelfServicePortal\SelfServicePortalFactory as SprykerSelfServicePortalFactory;
use SprykerFeature\Yves\SelfServicePortal\Service\Checker\AddressFormCheckerInterface;
use SprykerFeature\Yves\SelfServicePortal\Service\Handler\SingleAddressPerShipmentTypePreSubmitHandlerInterface;

class SelfServicePortalFactory extends SprykerSelfServicePortalFactory
{
    /**
     * @return \SprykerFeature\Yves\SelfServicePortal\Service\Checker\AddressFormCheckerInterface
     */
    public function createAddressFormChecker(): AddressFormCheckerInterface
    {
        return new AddressFormChecker($this->getConfig());
    }

    /**
     * @return \SprykerFeature\Yves\SelfServicePortal\Service\Handler\SingleAddressPerShipmentTypePreSubmitHandlerInterface
     */
    public function createSingleAddressPerShipmentTypePreSubmitHandler(): SingleAddressPerShipmentTypePreSubmitHandlerInterface
    {
        return new SingleAddressPerShipmentTypePreSubmitHandler($this->createAddressFormChecker());
    }
}
