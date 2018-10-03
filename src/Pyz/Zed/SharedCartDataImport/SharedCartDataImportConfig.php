<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\SharedCartDataImport;

use Spryker\Zed\SharedCartDataImport\SharedCartDataImportConfig as SprykerSharedCartDataImportConfig;

class SharedCartDataImportConfig extends SprykerSharedCartDataImportConfig
{
    /**
     * @return string
     */
    protected function getModuleRoot(): string
    {
        return realpath(APPLICATION_ROOT_DIR) . DIRECTORY_SEPARATOR;
    }
}
