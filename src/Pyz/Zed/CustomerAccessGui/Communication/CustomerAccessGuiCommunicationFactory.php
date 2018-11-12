<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccessGui\Communication;

use Generated\Shared\Transfer\CustomerAccessTransfer;
use Pyz\Zed\CustomerAccessGui\Communication\Form\CustomerAccessForm;
use Pyz\Zed\CustomerAccessGui\Communication\Form\DataProvider\CustomerAccessDataProvider;
use Spryker\Zed\CustomerAccessGui\Communication\CustomerAccessGuiCommunicationFactory as SprykerCustomerAccessGuiCommunicationFactory;

/**
 * @method \Spryker\Zed\CustomerAccessGui\CustomerAccessGuiConfig getConfig()
 */
class CustomerAccessGuiCommunicationFactory extends SprykerCustomerAccessGuiCommunicationFactory
{
    /**
     * @return \Pyz\Zed\CustomerAccessGui\Communication\Form\DataProvider\CustomerAccessDataProvider
     */
    public function createCustomerAccessDataProvider()
    {
        return new CustomerAccessDataProvider($this->getCustomerAccessFacade());
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     * @param array $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getCustomerAccessForm(CustomerAccessTransfer $customerAccessTransfer, array $options)
    {
        return $this->getFormFactory()->create(
            CustomerAccessForm::class,
            $customerAccessTransfer,
            $options
        );
    }
}
