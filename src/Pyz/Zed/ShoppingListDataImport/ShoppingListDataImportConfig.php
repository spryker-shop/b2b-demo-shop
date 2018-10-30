<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ShoppingListDataImport;

use Spryker\Zed\ShoppingListDataImport\ShoppingListDataImportConfig as CoreShoppingListDataImportConfig;

class ShoppingListDataImportConfig extends CoreShoppingListDataImportConfig
{
    /**
     * @return string
     */
    protected function getModuleRoot(): string
    {
        return APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR;
    }
}
