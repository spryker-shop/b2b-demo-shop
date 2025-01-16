<?php



declare(strict_types = 1);

namespace Pyz\Zed\CmsBlockStorage;

use Spryker\Zed\CmsBlockStorage\CmsBlockStorageDependencyProvider as SprykerCmsBlockStorageDependencyProvider;
use Spryker\Zed\CmsContentWidget\Communication\Plugin\CmsBlockStorage\CmsBlockStorageStorageParameterMapExpanderPlugin;

class CmsBlockStorageDependencyProvider extends SprykerCmsBlockStorageDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\CmsBlockStorage\Dependency\Plugin\CmsBlockStorageDataExpanderPluginInterface>
     */
    protected function getContentWidgetDataExpanderPlugins(): array
    {
        return [
            new CmsBlockStorageStorageParameterMapExpanderPlugin(),
        ];
    }
}
