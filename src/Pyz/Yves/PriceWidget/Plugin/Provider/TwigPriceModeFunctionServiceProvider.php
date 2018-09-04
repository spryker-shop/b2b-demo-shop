<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\PriceWidget\Plugin\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Twig_Environment;

/**
 * @method \SprykerShop\Yves\PriceWidget\PriceWidgetFactory getFactory()
 */
class TwigPriceModeFunctionServiceProvider extends AbstractPlugin implements ServiceProviderInterface
{
    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    public function register(Application $app): void
    {
        $app['priceMode'] = function () {
            return $this->getFactory()->getPriceClient()->getCurrentPriceMode();
        };
    }

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    public function boot(Application $app): void
    {
    }
}
