<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\DummyPayment;

use Pyz\Yves\DummyPayment\Form\DataProvider\DummyPaymentInvoiceFormDataProvider;
use Pyz\Yves\DummyPayment\Form\InvoiceSubForm;
use Spryker\Yves\DummyPayment\DummyPaymentFactory as SprykerDummyPaymentFactory;
use Symfony\Component\Form\FormTypeInterface;

class DummyPaymentFactory extends SprykerDummyPaymentFactory
{
    /**
     * @return \Symfony\Component\Form\FormTypeInterface
     */
    public function createPyzInvoiceForm(): FormTypeInterface
    {
        return new InvoiceSubForm();
    }

    /**
     * @return \Pyz\Yves\DummyPayment\Form\DataProvider\DummyPaymentInvoiceFormDataProvider
     */
    public function createPyzInvoiceFormDataProvider(): DummyPaymentInvoiceFormDataProvider
    {
        return new DummyPaymentInvoiceFormDataProvider();
    }
}
