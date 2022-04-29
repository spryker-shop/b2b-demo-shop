<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\DummyPayment\Plugin;

use Spryker\Yves\Kernel\AbstractPlugin;
use Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface;
use Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginInterface;
use Symfony\Component\Form\FormTypeInterface;

/**
 * @method \Pyz\Yves\DummyPayment\DummyPaymentFactory getFactory()
 */
class DummyPaymentInvoiceSubFormPlugin extends AbstractPlugin implements SubFormPluginInterface
{
    /**
     * @return \Symfony\Component\Form\FormTypeInterface
     */
    public function createSubForm(): FormTypeInterface
    {
        return $this->getFactory()->createPyzInvoiceForm();
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface
     */
    public function createSubFormDataProvider(): StepEngineFormDataProviderInterface
    {
        return $this->getFactory()->createPyzInvoiceFormDataProvider();
    }
}
