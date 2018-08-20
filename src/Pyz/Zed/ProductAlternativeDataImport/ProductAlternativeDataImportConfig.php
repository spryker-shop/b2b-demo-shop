<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductAlternativeDataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\ProductAlternativeDataImport\ProductAlternativeDataImportConfig as SprykerProductAlternativeDataImportConfig;

class ProductAlternativeDataImportConfig extends SprykerProductAlternativeDataImportConfig
{
    const IMPORT_TYPE_PRODUCT_ALTERNATIVE = 'product-alternative';

    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getProductAlternativeDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        $moduleDataImportDirectory = APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR
            . 'data' . DIRECTORY_SEPARATOR
            . 'import' . DIRECTORY_SEPARATOR
            . 'certeo' . DIRECTORY_SEPARATOR;

        return $this->buildImporterConfiguration($moduleDataImportDirectory . 'product_alternative.csv', static::IMPORT_TYPE_PRODUCT_ALTERNATIVE);
    }
}
