<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\QuoteRequestDataImport;

use Spryker\Zed\QuoteRequestDataImport\QuoteRequestDataImportConfig as SprykerQuoteRequestDataImportConfig;

class QuoteRequestDataImportConfig extends SprykerQuoteRequestDataImportConfig
{
    /**
     * @return string
     */
    protected function getModuleRoot(): string
    {
        return realpath(APPLICATION_ROOT_DIR) . DIRECTORY_SEPARATOR;
    }
}
