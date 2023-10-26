<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\Auth\Helper;

use Codeception\Module;
use Spryker\Zed\CompanyMailConnector\Business\CompanyMailConnectorBusinessFactory;
use Spryker\Zed\CompanyMailConnector\CompanyMailConnectorDependencyProvider;
use Spryker\Zed\CompanyMailConnector\Dependency\Facade\CompanyMailConnectorToMailFacadeBridge;
use SprykerTest\Shared\Testify\Helper\DependencyHelperTrait;
use SprykerTest\Shared\Testify\Helper\LocatorHelperTrait;

/**
 * Class CompanyMailConnectorDependencyHelper
 *
 * This helper is a workaround and must be deleted after the issue is solved.
 *
 * @see https://spryker.atlassian.net/browse/TE-4504
 */
class CompanyMailConnectorDependencyHelper extends Module
{
    use DependencyHelperTrait;
    use LocatorHelperTrait;

    /**
     * @return void
     */
    public function haveCompanyMailConnectorToMailDependency(): void
    {
        $mailFacade = $this->getLocator()->mail()->facade();
        $companyMailConnectorToMailFacadeBridge = new CompanyMailConnectorToMailFacadeBridge($mailFacade);

        $this->getDependencyHelper()->setDependency(
            CompanyMailConnectorDependencyProvider::FACADE_MAIL,
            $companyMailConnectorToMailFacadeBridge,
            CompanyMailConnectorBusinessFactory::class,
        );
    }
}
