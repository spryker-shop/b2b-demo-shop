<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CompanySupplierDataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\CompanySupplierDataImport\CompanySupplierDataImportConfig as SprykerCompanySupplierDataImportConfig;

class CompanySupplierDataImportConfig extends SprykerCompanySupplierDataImportConfig
{
    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getCompanyTypeDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        $moduleDataImportDirectory = APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR
            . 'data' . DIRECTORY_SEPARATOR
            . 'import' . DIRECTORY_SEPARATOR
            . 'certeo' . DIRECTORY_SEPARATOR;

        return $this->buildImporterConfiguration($moduleDataImportDirectory . 'company_type.csv', static::IMPORT_TYPE_COMPANY_TYPE);
    }

    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getCompanySupplierDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        $moduleDataImportDirectory = APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR
            . 'data' . DIRECTORY_SEPARATOR
            . 'import' . DIRECTORY_SEPARATOR
            . 'certeo' . DIRECTORY_SEPARATOR;

        return $this->buildImporterConfiguration($moduleDataImportDirectory . 'company_supplier.csv', static::IMPORT_TYPE_COMPANY_SUPPLIER);
    }

    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getCompanySupplierProductPriceDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        $moduleDataImportDirectory = APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR
            . 'data' . DIRECTORY_SEPARATOR
            . 'import' . DIRECTORY_SEPARATOR
            . 'certeo' . DIRECTORY_SEPARATOR;

        return $this->buildImporterConfiguration($moduleDataImportDirectory . 'company_supplier_product_price.csv', static::IMPORT_TYPE_PRODUCT_PRICE);
    }
}
