<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Client\CmsBlockStorage;

use Spryker\Client\CmsBlockStorage\CmsBlockStorageDependencyProvider as SprykerCmsBlockStorageDependencyProvider;
use SprykerFeature\Client\SelfServicePortal\Plugin\CmsBlockStorage\CmsBlockCompanyBusinessUnitCmsBlockStorageReaderPlugin;

class CmsBlockStorageDependencyProvider extends SprykerCmsBlockStorageDependencyProvider
{
    /**
     * @return array<\Spryker\Client\CmsBlockStorageExtension\Dependency\Plugin\CmsBlockStorageReaderPluginInterface>
     */
    protected function getCmsBlockStorageReaderPlugins(): array
    {
        return [
            new CmsBlockCompanyBusinessUnitCmsBlockStorageReaderPlugin(),
        ];
    }
}
