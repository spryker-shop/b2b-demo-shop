<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\DummyPayment\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Spryker\Yves\DummyPayment\Form\InvoiceSubForm as SprykerInvoiceSubForm;

class InvoiceSubForm extends SprykerInvoiceSubForm
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

    }
}
