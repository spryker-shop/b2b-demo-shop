<?php



declare(strict_types = 1);

namespace Pyz\Yves\CmsContentWidgetProductConnector;

use Spryker\Yves\CmsContentWidgetProductConnector\CmsContentWidgetProductConnectorConfig as SprykerCmsContentWidgetProductConnectorConfig;

class CmsContentWidgetProductConnectorConfig extends SprykerCmsContentWidgetProductConnectorConfig
{
    /**
     * @return bool
     */
    public function isUnavailableProductsDisplayed(): bool
    {
        return true;
    }
}
