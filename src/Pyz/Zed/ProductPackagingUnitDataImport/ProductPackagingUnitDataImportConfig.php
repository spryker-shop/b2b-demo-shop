<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductPackagingUnitDataImport;

use Spryker\Zed\ProductPackagingUnitDataImport\ProductPackagingUnitDataImportConfig as SprykerProductPackagingUnitDataImportConfig;

class ProductPackagingUnitDataImportConfig extends SprykerProductPackagingUnitDataImportConfig
{
    /**
     * @return string
     */
    protected function getModuleDataImportDirectory(): string
    {
        return $moduleDataImportDirectory = APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR
            . 'data' . DIRECTORY_SEPARATOR
            . 'import' . DIRECTORY_SEPARATOR
            . 'certeo' . DIRECTORY_SEPARATOR;
    }
}
