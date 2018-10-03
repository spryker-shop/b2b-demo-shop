<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\DummyPayment;

use Pyz\Yves\DummyPayment\Form\InvoiceSubForm;
use Spryker\Yves\DummyPayment\DummyPaymentFactory as SprykerDummyPaymentFactory;

class DummyPaymentFactory extends SprykerDummyPaymentFactory
{
    /**
     * @return \Spryker\Yves\DummyPayment\Form\InvoiceSubForm
     */
    public function createInvoiceForm()
    {
        return new InvoiceSubForm();
    }
}
