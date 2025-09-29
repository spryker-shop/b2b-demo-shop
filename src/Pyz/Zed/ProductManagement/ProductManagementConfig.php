<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ProductManagement;

use Spryker\Zed\ProductManagement\ProductManagementConfig as SprykerProductManagementConfig;

class ProductManagementConfig extends SprykerProductManagementConfig
{
    protected const PRODUCT_TABLE_FILTER_FORM_EXTERNAL_FIELD_NAMES = ['id-merchant'];

    public function isConcreteSkuSearchInProductTableEnabled(): bool
    {
        return true;
    }
}
