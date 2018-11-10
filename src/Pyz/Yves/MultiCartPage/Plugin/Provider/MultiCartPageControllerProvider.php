<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\MultiCartPage\Plugin\Provider;

use Silex\Application;
use SprykerShop\Yves\MultiCartPage\Plugin\Provider\MultiCartPageControllerProvider as SprykerShopMultiCartPageControllerProvider;

class MultiCartPageControllerProvider extends SprykerShopMultiCartPageControllerProvider
{
    public const ROUTE_MULTI_CART_SET_DEFAULT_BACK = 'multi-cart/set-default-back';

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app)
    {
        $this->addMultiCartCreateRoute()
            ->addMultiCartUpdateRoute()
            ->addMultiCartDeleteRoute()
            ->addMultiCartConfirmDeleteRoute()
            ->addMultiCartClearRoute()
            ->addMultiCartDuplicateRoute()
            ->addMultiCartSetDefaultRoute()
            ->addMultiCartIndexRoute()
            ->addMultiCartSetDefaultBackRoute();
    }

    /**
     * @return $this
     */
    protected function addMultiCartSetDefaultBackRoute(): self
    {
        $this->createGetController('/{multiCart}/set-default-back/{idQuote}', static::ROUTE_MULTI_CART_SET_DEFAULT_BACK, 'MultiCartPage', 'MultiCart', 'setDefaultBack')
            ->assert('multiCart', $this->getAllowedLocalesPattern() . 'multi-cart|multi-cart')
            ->assert(self::PARAM_ID_QUOTE, '\d+')
            ->value('multiCart', 'multi-cart');

        return $this;
    }
}
