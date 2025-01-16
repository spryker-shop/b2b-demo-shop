<?php



declare(strict_types = 1);

namespace Pyz\Yves\DummyPayment\Dependency\Injector;

use Spryker\Yves\Checkout\CheckoutDependencyProvider;
use Spryker\Yves\DummyPayment\Dependency\Injector\CheckoutPageDependencyInjector as SprykerCheckoutPageDependencyInjector;
use Spryker\Yves\DummyPayment\Plugin\DummyPaymentInvoiceSubFormPlugin;
use Spryker\Yves\Kernel\Container;
use Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection;

class CheckoutPageDependencyInjector extends SprykerCheckoutPageDependencyInjector
{
    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function injectPaymentSubForms(Container $container): Container
    {
        $container->extend(CheckoutDependencyProvider::PAYMENT_SUB_FORMS, function (SubFormPluginCollection $paymentSubForms) {
            $paymentSubForms->add(new DummyPaymentInvoiceSubFormPlugin());

            return $paymentSubForms;
        });

        return $container;
    }
}
