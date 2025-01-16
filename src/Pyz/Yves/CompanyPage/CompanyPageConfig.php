<?php



declare(strict_types = 1);

namespace Pyz\Yves\CompanyPage;

use SprykerShop\Yves\CompanyPage\CompanyPageConfig as SprykerCompanyPageConfig;

class CompanyPageConfig extends SprykerCompanyPageConfig
{
    /**
     * @var string
     */
    protected const ZIP_CODE_CONSTRAINT_PATTERN = '/^\d+$/';
}
