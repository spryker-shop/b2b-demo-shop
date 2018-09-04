<?php

namespace Pyz\Zed\CompanyRoleDataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\CompanyRoleDataImport\CompanyRoleDataImportConfig as SprykerCompanyRoleDataImportConfig;

class CompanyRoleDataImportConfig extends SprykerCompanyRoleDataImportConfig
{
    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getCompanyRolePermissionDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        $moduleDataImportDirectory = APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR
            . 'data' . DIRECTORY_SEPARATOR
            . 'import' . DIRECTORY_SEPARATOR;

        return $this->buildImporterConfiguration(
            implode(DIRECTORY_SEPARATOR, [$moduleDataImportDirectory, 'company_role_permission.csv']),
            static::IMPORT_TYPE_COMPANY_ROLE_PERMISSION
        );
    }
}