<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Service\Flysystem;

use Spryker\Service\Flysystem\FlysystemDependencyProvider as SprykerFlysystemDependencyProvider;
use Spryker\Service\FlysystemFtpFileSystem\Plugin\Flysystem\FtpFilesystemBuilderPlugin;
use Spryker\Service\FlysystemLocalFileSystem\Plugin\Flysystem\LocalFilesystemBuilderPlugin;
use Spryker\Service\Kernel\Container;

class FlysystemDependencyProvider extends SprykerFlysystemDependencyProvider
{
    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    protected function addFilesystemBuilderPluginCollection($container): Container
    {
        $container->set(static::PLUGIN_COLLECTION_FILESYSTEM_BUILDER, function (Container $container) {
            return [
                new FtpFilesystemBuilderPlugin(),
                new LocalFilesystemBuilderPlugin(),
            ];
        });

        return $container;
    }
}
