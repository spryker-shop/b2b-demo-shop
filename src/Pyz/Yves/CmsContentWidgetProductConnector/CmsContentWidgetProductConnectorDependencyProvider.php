<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CmsContentWidgetProductConnector;

use SprykerShop\Yves\CmsContentWidgetProductConnector\CmsContentWidgetProductConnectorDependencyProvider as SprykerShopCmsContentWidgetProductConnectorDependencyProvider;

class CmsContentWidgetProductConnectorDependencyProvider extends SprykerShopCmsContentWidgetProductConnectorDependencyProvider
{
    /**
     * @return string[]
     */
    protected function getCmsProductContentWidgetPlugins(): array
    {
        return [];
    }
}
