<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CmsStorage;

use Spryker\Zed\Cms\Dependency\Plugin\CmsPageDataExpanderPluginInterface;
use Spryker\Zed\CmsContentWidget\Communication\Plugin\CmsPageDataExpander\CmsPageParameterMapExpanderPlugin;
use Spryker\Zed\CmsStorage\CmsStorageDependencyProvider as SprykerCmsStorageDependencyProvider;

class CmsStorageDependencyProvider extends SprykerCmsStorageDependencyProvider
{

    /**
     * @return CmsPageDataExpanderPluginInterface[]
     */
    protected function getContentWidgetDataExpander()
    {
        return [
            new CmsPageParameterMapExpanderPlugin()
        ];
    }

}
