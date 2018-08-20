<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\ProductDiscontinuedDataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\ProductDiscontinuedDataImport\ProductDiscontinuedDataImportConfig as SprykerProductDiscontinuedDataImportConfig;

class ProductDiscontinuedDataImportConfig extends SprykerProductDiscontinuedDataImportConfig
{
    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getProductDiscontinuedDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        $moduleDataImportDirectory = APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR
            . 'data' . DIRECTORY_SEPARATOR
            . 'import' . DIRECTORY_SEPARATOR
            . 'certeo' . DIRECTORY_SEPARATOR;

        return $this->buildImporterConfiguration(
            $moduleDataImportDirectory . 'product_discontinued.csv',
            static::IMPORT_TYPE_PRODUCT_DISCONTINUED
        );
    }
}
