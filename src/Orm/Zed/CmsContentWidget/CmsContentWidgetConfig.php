<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CmsContentWidget;

use Spryker\Zed\CmsContentWidget\CmsContentWidgetConfig as SprykerCmsContentWidgetConfig;
use SprykerShop\Shared\CmsContentWidgetChartConnector\ContentWidgetConfigurationProvider\CmsChartContentWidgetConfigurationProvider;

class CmsContentWidgetConfig extends SprykerCmsContentWidgetConfig
{
    public function __construct()
    {
    }

    /**
     * This is cms content widget configuration provider list, its used to get configuration when building widgets.
     * Also to display usage information in cms placeholder edit page
     * Its created in shared because its needed by Yves and Zed.
     *
     * Should be registered in key value pairs where key is function name and value concrete configuration provider.
     *
     * @return \Spryker\Shared\CmsContentWidget\Dependency\CmsContentWidgetConfigurationProviderInterface[]
     */
    public function getCmsContentWidgetConfigurationProviders()
    {
        return [
            CmsChartContentWidgetConfigurationProvider::FUNCTION_NAME => new CmsChartContentWidgetConfigurationProvider(),
        ];
    }
}
