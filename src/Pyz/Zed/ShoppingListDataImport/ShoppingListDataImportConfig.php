<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ShoppingListDataImport;

use Spryker\Zed\ShoppingListDataImport\ShoppingListDataImportConfig as SprykerShoppingListDataImportConfig;

class ShoppingListDataImportConfig extends SprykerShoppingListDataImportConfig
{
    /**
     * @return string
     */
    protected function getModuleRoot(): string
    {
        return APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR;
    }
}
