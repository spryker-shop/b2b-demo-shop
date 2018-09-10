<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\DummyPayment;

use Spryker\Yves\DummyPayment\Form\CreditCardSubForm;
use Spryker\Yves\DummyPayment\Form\DataProvider\DummyPaymentCreditCardFormDataProvider;
use Spryker\Yves\DummyPayment\Form\DataProvider\DummyPaymentInvoiceFormDataProvider;
use Spryker\Yves\DummyPayment\Form\InvoiceSubForm;
use Spryker\Yves\DummyPayment\Handler\DummyPaymentHandler;
use Spryker\Yves\Kernel\AbstractFactory;

class DummyPaymentFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Yves\DummyPayment\Form\CreditCardSubForm
     */
    public function createCreditCardForm()
    {
        return new CreditCardSubForm();
    }

    /**
     * @return \Spryker\Yves\DummyPayment\Form\DataProvider\DummyPaymentCreditCardFormDataProvider
     */
    public function createCreditCardFormDataProvider()
    {
        return new DummyPaymentCreditCardFormDataProvider();
    }

    /**
     * @return \Spryker\Yves\DummyPayment\Form\InvoiceSubForm
     */
    public function createInvoiceForm()
    {
        return new InvoiceSubForm();
    }

    /**
     * @return \Spryker\Yves\DummyPayment\Form\DataProvider\DummyPaymentInvoiceFormDataProvider
     */
    public function createInvoiceFormDataProvider()
    {
        return new DummyPaymentInvoiceFormDataProvider();
    }

    /**
     * @return \Spryker\Yves\DummyPayment\Handler\DummyPaymentHandler
     */
    public function createDummyPaymentHandler()
    {
        return new DummyPaymentHandler();
    }
}
