<?php



declare(strict_types = 1);

namespace Pyz\Zed\FileManagerGui;

use Spryker\Zed\FileManagerGui\FileManagerGuiConfig as SprykerFileManagerGuiConfig;

class FileManagerGuiConfig extends SprykerFileManagerGuiConfig
{
    /**
     * @var bool
     */
    protected const IS_FILE_EXTENSION_VALIDATION_ENABLED = true;

    /**
     * @var bool
     */
    protected const IS_EMPTY_TYPES_VALIDATION_ENABLED = true;
}
