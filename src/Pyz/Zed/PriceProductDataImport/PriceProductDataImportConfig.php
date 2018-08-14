<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\PriceProductDataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\PriceProductDataImport\PriceProductDataImportConfig as SprykerPriceProductDataImportConfig;

class PriceProductDataImportConfig extends SprykerPriceProductDataImportConfig
{
    public const IMPORT_TYPE_PRODUCT_PRICE = 'product-price';

    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getPriceProductDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        $moduleDataImportDirectory = APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR
            . 'data' . DIRECTORY_SEPARATOR
            . 'import' . DIRECTORY_SEPARATOR
            . 'certeo' . DIRECTORY_SEPARATOR;

        return $this->buildImporterConfiguration($moduleDataImportDirectory . 'product_price.csv', static::IMPORT_TYPE_PRODUCT_PRICE);
    }
}
