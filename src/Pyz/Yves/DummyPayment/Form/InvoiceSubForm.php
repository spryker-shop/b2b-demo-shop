<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\DummyPayment\Form;

use Spryker\Yves\DummyPayment\Form\InvoiceSubForm as SprykerInvoiceSubForm;
use Symfony\Component\Form\FormBuilderInterface;

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
