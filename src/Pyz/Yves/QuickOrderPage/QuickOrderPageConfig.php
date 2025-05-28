<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\QuickOrderPage;

use SprykerShop\Yves\QuickOrderPage\QuickOrderPageConfig as SprykerQuickOrderPageConfig;

class QuickOrderPageConfig extends SprykerQuickOrderPageConfig
{
    /**
     * @var int
     */
    protected const MAX_FILE_COUNT = 1;

    /**
     * @var string
     */
    protected const MAX_TOTAL_FILE_SIZE = '5 MB';

    /**
     * @var string
     */
    protected const DISPLAY_ALLOWED_FILE_TYPES_TEXT = 'csv';

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

    /**
     * @api
     *
     * @return int
     */
    public function getMaxFileCount(): int
    {
        return static::MAX_FILE_COUNT;
    }

    /**
     * @api
     *
     * @return string
     */
    public function getMaxTotalFileSize(): string
    {
        return static::MAX_TOTAL_FILE_SIZE;
    }

    /**
     * @api
     *
     * @return string
     */
    public function getDisplayAllowedFileTypesText(): string
    {
        return static::DISPLAY_ALLOWED_FILE_TYPES_TEXT;
    }
}
