<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyUser\Business;

use Pyz\Zed\CompanyUser\Model\CompanyUser;
use Spryker\Zed\CompanyUser\Business\CompanyUserBusinessFactory as SprykerCompanyUserBusinessFactory;
use Spryker\Zed\CompanyUser\Business\Model\CompanyUserInterface;

class CompanyUserBusinessFactory extends SprykerCompanyUserBusinessFactory
{
    /**
     * @return \Pyz\Zed\CompanyUser\Model\CompanyUserInterface
     */
    public function createCompanyUser(): CompanyUserInterface
    {
        return new CompanyUser(
            $this->getRepository(),
            $this->getEntityManager(),
            $this->getCustomerFacade(),
            $this->createCompanyUserPluginExecutor(),
            $this->getCompanyUserSavePreCheckPlugins()
        );
    }
}
