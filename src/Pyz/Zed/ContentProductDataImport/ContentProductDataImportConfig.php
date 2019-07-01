<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ContentProductDataImport;

use Spryker\Zed\ContentProductDataImport\ContentProductDataImportConfig as SprykerContentProductDataImportConfig;

class ContentProductDataImportConfig extends SprykerContentProductDataImportConfig
{
    /**
     * @return string
     */
    protected function getModuleRoot(): string
    {
        return realpath(APPLICATION_ROOT_DIR) . DIRECTORY_SEPARATOR;
    }
}
