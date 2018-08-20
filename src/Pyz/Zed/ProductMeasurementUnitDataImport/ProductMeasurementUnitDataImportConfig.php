<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductMeasurementUnitDataImport;

use Spryker\Zed\ProductMeasurementUnitDataImport\ProductMeasurementUnitDataImportConfig as SprykerProductMeasurementUnitDataImportConfig;

class ProductMeasurementUnitDataImportConfig extends SprykerProductMeasurementUnitDataImportConfig
{
    /**
     * @return string
     */
    protected function getModuleDataImportDirectory(): string
    {
        $moduleDataImportDirectory = APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR
            . 'data' . DIRECTORY_SEPARATOR
            . 'import' . DIRECTORY_SEPARATOR
            . 'certeo' . DIRECTORY_SEPARATOR;

        return $moduleDataImportDirectory;
    }
}
