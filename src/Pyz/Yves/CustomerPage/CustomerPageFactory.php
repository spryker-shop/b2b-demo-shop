<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Yves\CustomerPage;

use Pyz\Yves\CustomerPage\Form\DataProvider\CheckoutAddressFormDataProvider;
use Spryker\Client\Session\SessionClientInterface;
use SprykerShop\Yves\CustomerPage\CustomerPageFactory as SprykerCustomerPageFactory;

class CustomerPageFactory extends SprykerCustomerPageFactory
{
    /**
     * @return \Pyz\Yves\CustomerPage\Form\DataProvider\CheckoutAddressFormDataProvider
     */
    public function createCheckoutAddressFormDataProvider(): CheckoutAddressFormDataProvider
    {
        return new CheckoutAddressFormDataProvider(
            $this->getCustomerClient(),
            $this->getStoreClient(),
            $this->getCustomerService(),
            $this->getShipmentClient(),
            $this->getProductBundleClient(),
            $this->getShipmentService(),
            $this->createAddressChoicesResolver(),
            $this->getCheckoutAddressCollectionFormExpanderPlugins(),
        );
    }

    /**
     * @return \Spryker\Client\Session\SessionClientInterface
     */
    public function getSessionClient(): SessionClientInterface
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::CLIENT_SESSION);
    }
}
