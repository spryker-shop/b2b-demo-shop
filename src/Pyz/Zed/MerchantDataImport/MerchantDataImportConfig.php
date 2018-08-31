<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\MerchantDataImport;

use Spryker\Zed\MerchantDataImport\MerchantDataImportConfig as SprykerMerchantDataImportConfig;

class MerchantDataImportConfig extends SprykerMerchantDataImportConfig
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
