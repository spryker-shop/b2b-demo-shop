<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\CustomerAccessGui\Communication;

use Generated\Shared\Transfer\CustomerAccessTransfer;
use Pyz\Zed\CustomerAccess\Business\CustomerAccessFacadeInterface;
use Pyz\Zed\CustomerAccessGui\Communication\Form\CustomerAccessForm;
use Pyz\Zed\CustomerAccessGui\Communication\Form\DataProvider\CustomerAccessDataProvider;
use Pyz\Zed\CustomerAccessGui\CustomerAccessGuiDependencyProvider;
use Spryker\Zed\CustomerAccessGui\Communication\CustomerAccessGuiCommunicationFactory as SprykerCustomerAccessGuiCommunicationFactory;
use Symfony\Component\Form\FormInterface;

/**
 * @method \Spryker\Zed\CustomerAccessGui\CustomerAccessGuiConfig getConfig()
 */
class CustomerAccessGuiCommunicationFactory extends SprykerCustomerAccessGuiCommunicationFactory
{
    /**
     * @return \Pyz\Zed\CustomerAccessGui\Communication\Form\DataProvider\CustomerAccessDataProvider
     */
    public function createPyzCustomerAccessDataProvider(): CustomerAccessDataProvider
    {
        return new CustomerAccessDataProvider($this->getPyzCustomerAccessFacade());
    }

    /**
     * @return \Pyz\Zed\CustomerAccess\Business\CustomerAccessFacadeInterface
     */
    public function getPyzCustomerAccessFacade(): CustomerAccessFacadeInterface
    {
        return $this->getProvidedDependency(CustomerAccessGuiDependencyProvider::PYZ_FACADE_CUSTOMER_ACCESS);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerAccessTransfer $customerAccessTransfer
     * @param array $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getPyzCustomerAccessForm(CustomerAccessTransfer $customerAccessTransfer, array $options): FormInterface
    {
        return $this->getFormFactory()->create(
            CustomerAccessForm::class,
            $customerAccessTransfer,
            $options,
        );
    }
}
