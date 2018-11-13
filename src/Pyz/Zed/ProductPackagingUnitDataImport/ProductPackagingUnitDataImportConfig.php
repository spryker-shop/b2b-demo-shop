<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductPackagingUnitDataImport;

use Spryker\Zed\ProductPackagingUnitDataImport\ProductPackagingUnitDataImportConfig as SprykerProductPackagingUnitDataImportConfig;

class ProductPackagingUnitDataImportConfig extends SprykerProductPackagingUnitDataImportConfig
{
    /**
     * @return string
     */
    protected function getModuleRoot(): string
    {
        $moduleRoot = realpath(APPLICATION_ROOT_DIR);

        return $moduleRoot . DIRECTORY_SEPARATOR;
    }
}
