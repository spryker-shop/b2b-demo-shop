<?php

namespace Pyz\Client\CmsBlockStorage;

use Spryker\Client\CmsBlockStorage\CmsBlockStorageDependencyProvider as SprykerCmsBlockStorageDependencyProvider;
use SprykerFeature\Client\SelfServicePortal\Plugin\CmsBlockStorage\CmsBlockCompanyBusinessUnitCmsBlockStorageReaderPlugin;

class CmsBlockStorageDependencyProvider extends SprykerCmsBlockStorageDependencyProvider
{
    protected function getCmsBlockStorageReaderPlugins(): array
    {
        return [
            new CmsBlockCompanyBusinessUnitCmsBlockStorageReaderPlugin(),
        ];
    }
}
