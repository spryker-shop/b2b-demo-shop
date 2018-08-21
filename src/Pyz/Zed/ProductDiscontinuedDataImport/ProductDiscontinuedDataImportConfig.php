<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ProductDiscontinuedDataImport;

use Spryker\Zed\ProductDiscontinuedDataImport\ProductDiscontinuedDataImportConfig as SprykerProductDiscontinuedDataImportConfig;

class ProductDiscontinuedDataImportConfig extends SprykerProductDiscontinuedDataImportConfig
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
