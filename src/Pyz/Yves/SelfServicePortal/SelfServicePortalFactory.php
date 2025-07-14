<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\SelfServicePortal;

use Pyz\Yves\SelfServicePortal\Service\Checker\AddressFormChecker;
use SprykerFeature\Yves\SelfServicePortal\SelfServicePortalFactory as SprykerSelfServicePortalFactory;
use SprykerFeature\Yves\SelfServicePortal\Service\Checker\AddressFormCheckerInterface;

class SelfServicePortalFactory extends SprykerSelfServicePortalFactory
{
    /**
     * @return \SprykerFeature\Yves\SelfServicePortal\Service\Checker\AddressFormCheckerInterface
     */
    public function createAddressFormChecker(): AddressFormCheckerInterface
    {
        return new AddressFormChecker($this->getConfig());
    }
}
