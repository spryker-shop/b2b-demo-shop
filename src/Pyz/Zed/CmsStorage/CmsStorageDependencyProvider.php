<?php



declare(strict_types = 1);

namespace Pyz\Zed\CmsStorage;

use Spryker\Zed\CmsContentWidget\Communication\Plugin\CmsPageDataExpander\CmsPageParameterMapExpanderPlugin;
use Spryker\Zed\CmsStorage\CmsStorageDependencyProvider as SprykerCmsStorageDependencyProvider;

class CmsStorageDependencyProvider extends SprykerCmsStorageDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\CmsExtension\Dependency\Plugin\CmsPageDataExpanderPluginInterface>
     */
    protected function getContentWidgetDataExpander(): array
    {
        return [
            new CmsPageParameterMapExpanderPlugin(),
        ];
    }
}
