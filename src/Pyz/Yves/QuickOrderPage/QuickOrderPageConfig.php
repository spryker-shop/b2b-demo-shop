<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\QuickOrderPage;

use SprykerShop\Yves\QuickOrderPage\QuickOrderPageConfig as SprykerQuickOrderPageConfig;

class QuickOrderPageConfig extends SprykerQuickOrderPageConfig
{
    /**
     * @var array<string>
     */
    protected const ALLOWED_CSV_FILE_MIME_TYPES = [
        'text/csv',
        'text/plain',
        'text/x-csv',
        'application/vnd.ms-excel',
        'application/csv',
        'application/x-csv',
        'text/comma-separated-values',
        'text/x-comma-separated-values',
        'text/tab-separated-values',
        'application/octet-stream',
    ];
}
