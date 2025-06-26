<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\FileManager;

use Spryker\Zed\FileManager\FileManagerDependencyProvider as SprykerFileManagerDependencyProvider;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\FileManager\FileAttachmentFilePreDeletePlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\FileManager\SspAssetManagementFilePreDeletePlugin;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\FileManager\SspInquiryManagementFilePreDeletePlugin;

class FileManagerDependencyProvider extends SprykerFileManagerDependencyProvider
{
    /**
     * @return list<\Spryker\Zed\FileManagerExtension\Dependency\Plugin\FilePreDeletePluginInterface>
     */
    protected function getFilePreDeletePlugins(): array
    {
        return [
            new FileAttachmentFilePreDeletePlugin(),
            new SspInquiryManagementFilePreDeletePlugin(),
            new SspAssetManagementFilePreDeletePlugin(),
        ];
    }
}
