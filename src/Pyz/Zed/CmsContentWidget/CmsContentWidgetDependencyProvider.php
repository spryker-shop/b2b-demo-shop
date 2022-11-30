<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CmsContentWidget;

use Spryker\Shared\CmsContentWidgetProductConnector\ContentWidgetConfigurationProvider\CmsProductContentWidgetConfigurationProvider;
use Spryker\Shared\CmsContentWidgetProductGroupConnector\ContentWidgetConfigurationProvider\CmsProductGroupContentWidgetConfigurationProvider;
use Spryker\Shared\CmsContentWidgetProductSetConnector\ContentWidgetConfigurationProvider\CmsProductSetContentWidgetConfigurationProvider;
use Spryker\Shared\ContentBanner\ContentBannerConfig;
use Spryker\Shared\ContentProduct\ContentProductConfig;
use Spryker\Zed\CmsContentWidget\CmsContentWidgetDependencyProvider as SprykerCmsContentWidgetDependencyProvider;
use Spryker\Zed\CmsContentWidgetContentConnector\Communication\Plugin\Cms\CmsContentItemKeyMapperPlugin;
use Spryker\Zed\CmsContentWidgetProductConnector\Communication\Plugin\Cms\CmsProductSkuMapperPlugin;
use Spryker\Zed\CmsContentWidgetProductSetConnector\Communication\Plugin\Cms\CmsProductSetKeyMapperPlugin;
use Spryker\Zed\Kernel\Container;

class CmsContentWidgetDependencyProvider extends SprykerCmsContentWidgetDependencyProvider
{
    /**
     * {@inheritDoc}
     *
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\CmsContentWidget\Dependency\Plugin\CmsContentWidgetParameterMapperPluginInterface[]
     */
    protected function getCmsContentWidgetParameterMapperPlugins(Container $container)
    {
        return [
            CmsProductContentWidgetConfigurationProvider::FUNCTION_NAME => new CmsProductSkuMapperPlugin(),
            CmsProductSetContentWidgetConfigurationProvider::FUNCTION_NAME => new CmsProductSetKeyMapperPlugin(),
            CmsProductGroupContentWidgetConfigurationProvider::FUNCTION_NAME => new CmsProductSkuMapperPlugin(),
            ContentBannerConfig::TWIG_FUNCTION_NAME => new CmsContentItemKeyMapperPlugin(),
            ContentProductConfig::TWIG_FUNCTION_NAME => new CmsContentItemKeyMapperPlugin(),
            new CmsContentItemKeyMapperPlugin(),
        ];
    }
}
