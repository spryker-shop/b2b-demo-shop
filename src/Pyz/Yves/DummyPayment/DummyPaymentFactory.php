<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\DummyPayment;

use Pyz\Yves\DummyPayment\Form\InvoiceSubForm;
use Spryker\Yves\DummyPayment\DummyPaymentFactory as SprykerDummyPaymentFactory;
use Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface;

class DummyPaymentFactory extends SprykerDummyPaymentFactory
{
    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface
     */
    public function createInvoiceForm(): SubFormInterface
    {
        return new InvoiceSubForm();
    }
}
