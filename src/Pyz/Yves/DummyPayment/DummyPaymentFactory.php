<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
