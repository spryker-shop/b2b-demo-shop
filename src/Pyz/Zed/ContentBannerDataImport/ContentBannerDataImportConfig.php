<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ContentBannerDataImport;

use Spryker\Zed\ContentBannerDataImport\ContentBannerDataImportConfig as SprykerContentBannerDataImportConfig;

class ContentBannerDataImportConfig extends SprykerContentBannerDataImportConfig
{
    /**
     * @return string
     */
    protected function getModuleRoot(): string
    {
        return realpath(APPLICATION_ROOT_DIR) . DIRECTORY_SEPARATOR;
    }
}
