<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Plugin\Provider;

use SprykerShop\Yves\CustomerPage\Plugin\Provider\CustomerTwigFunctionServiceProvider as SprykerCustomerTwigFunctionServiceProvider;
use Twig_Environment;
use Twig_SimpleFunction;

/**
 * @method \SprykerShop\Yves\CustomerPage\CustomerPageFactory getFactory()
 */
class CustomerTwigFunctionServiceProvider extends SprykerCustomerTwigFunctionServiceProvider
{

    /**
     * @param \Twig_Environment $twig
     *
     * @return \Twig_Environment
     */
    protected function registerCustomerTwigFunction(Twig_Environment $twig)
    {
        $twig->addFunction(
            'hasCompanyAccess',
            new Twig_SimpleFunction('hasCompanyAccess', function () {

                $customerTransfer = $this->getFactory()->getCustomerClient()->getCustomer();

                return (!$customerTransfer || !$customerTransfer->getCompanyUserTransfer() && !$customerTransfer->getIsOnBehalf()) ? false : true;
            })
        );

        $twig->addFunction(
            'isLoggedIn',
            new Twig_SimpleFunction('isLoggedIn', function () {
                return $this->getFactory()->getCustomerClient()->isLoggedIn();
            })
        );

        return $twig;
    }
}
