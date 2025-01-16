<?php



declare(strict_types = 1);

namespace Pyz\Yves\ConfigurableBundleWidget;

use SprykerShop\Yves\ConfigurableBundleWidget\ConfigurableBundleWidgetConfig as SprykerShopConfigurableBundleWidgetConfig;

class ConfigurableBundleWidgetConfig extends SprykerShopConfigurableBundleWidgetConfig
{
    /**
     * @return bool
     */
    public function isQuantityChangeable(): bool
    {
        return true;
    }
}
