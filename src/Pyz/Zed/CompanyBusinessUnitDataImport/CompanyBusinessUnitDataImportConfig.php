<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CompanyBusinessUnitDataImport;

use Spryker\Zed\CompanyBusinessUnitDataImport\CompanyBusinessUnitDataImportConfig as SprykerCompanyBusinessUnitDataImportConfig;

class CompanyBusinessUnitDataImportConfig extends SprykerCompanyBusinessUnitDataImportConfig
{
    /**
     * @return string
     */
    protected function getModuleRoot(): string
    {
        return realpath(APPLICATION_ROOT_DIR);
    }
}
