<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
