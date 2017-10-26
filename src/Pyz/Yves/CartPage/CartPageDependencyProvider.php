<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CartPage;

use Spryker\Yves\Kernel\Container;
use SprykerShop\Yves\CartPage\CartPageDependencyProvider as SprykerCartPageDependencyProvider;
use SprykerShop\Yves\DiscountWidget\Plugin\CartPage\DiscountSummaryWidgetPlugin;
use SprykerShop\Yves\DiscountWidget\Plugin\CartPage\DiscountVoucherFormWidgetPlugin;

class CartPageDependencyProvider extends SprykerCartPageDependencyProvider
{

    /**
     * @param Container $container
     *
     * @return array
     */
    protected function getCartPageWidgetPlugins(Container $container): array
    {
        return [
            DiscountVoucherFormWidgetPlugin::class,
            DiscountSummaryWidgetPlugin::class
        ];
    }

}
