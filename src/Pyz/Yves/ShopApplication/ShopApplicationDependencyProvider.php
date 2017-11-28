<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\ShopApplication;

use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\CurrencyWidget\Plugin\ShopLayout\CurrencyWidgetPlugin;
use SprykerShop\Yves\ShopApplication\ShopApplicationDependencyProvider as SprykerShopApplicationDependencyProvider;

class ShopApplicationDependencyProvider extends SprykerShopApplicationDependencyProvider
{

    /**
     * @param Container $container
     *
     * @return string[]
     */
    protected function getGlobalWidgetPlugins(Container $container): array
    {
        return [
            CurrencyWidgetPlugin::class,
        ];
    }

}
