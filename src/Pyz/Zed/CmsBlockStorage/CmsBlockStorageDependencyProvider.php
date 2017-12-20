<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CmsBlockStorage;

use Spryker\Zed\CmsBlockStorage\CmsBlockStorageDependencyProvider as SprykerCmsBlockStorageDependencyProvider;
use Spryker\Zed\CmsBlockStorage\Dependency\Plugin\CmsBlockStorageDataExpanderPluginInterface;
use Spryker\Zed\CmsContentWidget\Communication\Plugin\CmsBlockStorage\CmsBlockStorageStorageParameterMapExpanderPlugin;

class CmsBlockStorageDependencyProvider extends SprykerCmsBlockStorageDependencyProvider
{

    /**
     * @return CmsBlockStorageDataExpanderPluginInterface[]
     */
    protected function getContentWidgetDataExpanderPlugins()
    {
        return [
            new CmsBlockStorageStorageParameterMapExpanderPlugin()
        ];
    }
}
