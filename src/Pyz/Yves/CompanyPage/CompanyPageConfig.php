<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CompanyPage;

use SprykerShop\Yves\CompanyPage\CompanyPageConfig as SprykerCompanyPageConfig;

class CompanyPageConfig extends SprykerCompanyPageConfig
{
    /**
     * @var string
     */
    protected const ZIP_CODE_CONSTRAINT_PATTERN = '/^\d+$/';
}
