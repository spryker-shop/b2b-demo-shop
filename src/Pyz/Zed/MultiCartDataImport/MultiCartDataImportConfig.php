<?php

namespace Pyz\Zed\MultiCartDataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\MultiCartDataImport\MultiCartDataImportConfig as CoreMultiCartDataImportConfig;

class MultiCartDataImportConfig extends CoreMultiCartDataImportConfig
{
    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getMultiCartDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        $moduleDataImportDirectory = APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR
            . 'data' . DIRECTORY_SEPARATOR
            . 'import' . DIRECTORY_SEPARATOR;

        return $this->buildImporterConfiguration(
            $moduleDataImportDirectory . static::FILE_NAME,
            static::IMPORT_TYPE_MULTI_CART
        );
    }
}
