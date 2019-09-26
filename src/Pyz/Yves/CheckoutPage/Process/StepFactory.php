<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CheckoutPage\Process;

use Pyz\Yves\CheckoutPage\CheckoutPageDependencyProvider;
use Pyz\Yves\CheckoutPage\Dependency\Client\CheckoutPageToProductStorageClientInterface;
use Pyz\Yves\CheckoutPage\Plugin\Provider\CartItemsProductProvider;
use Pyz\Yves\CheckoutPage\Plugin\Provider\CartItemsProductProviderInterface;
use Pyz\Yves\CheckoutPage\Process\Steps\AddressStep;
use Pyz\Yves\CheckoutPage\Process\Steps\ShipmentStep;
use Pyz\Yves\CheckoutPage\Process\Steps\SummaryStep;
use SprykerShop\Yves\CheckoutPage\Plugin\Provider\CheckoutPageControllerProvider;
use SprykerShop\Yves\CheckoutPage\Process\StepFactory as SprykerShopStepFactory;
use SprykerShop\Yves\CheckoutPage\Process\Steps\AddressStep as SpykerShopAddressStep;
use SprykerShop\Yves\HomePage\Plugin\Provider\HomePageControllerProvider;

class StepFactory extends SprykerShopStepFactory
{
    /**
     * @return \Pyz\Yves\CheckoutPage\Process\Steps\AddressStep
     */
    public function createAddressStep(): SpykerShopAddressStep
    {
        return new AddressStep(
            $this->getCalculationClient(),
            $this->createAddressStepExecutor(),
            $this->createAddressStepPostConditionChecker(),
            $this->getConfig(),
            $this->getStore(),
            $this->createCartItemsProductsProvider(),
            CheckoutPageControllerProvider::CHECKOUT_ADDRESS,
            HomePageControllerProvider::ROUTE_HOME
        );
    }

    /**
     * @return \Pyz\Yves\CheckoutPage\Process\Steps\ShipmentStep
     */
    public function createShipmentStep()
    {
        return new ShipmentStep(
            $this->getCalculationClient(),
            $this->getShipmentPlugins(),
            $this->createShipmentStepPostConditionChecker(),
            $this->createGiftCardItemsChecker(),
            $this->getStore(),
            $this->createCartItemsProductsProvider(),
            CheckoutPageControllerProvider::CHECKOUT_SHIPMENT,
            HomePageControllerProvider::ROUTE_HOME
        );
    }

    /**
     * @return \Pyz\Yves\CheckoutPage\Process\Steps\SummaryStep
     */
    public function createSummaryStep()
    {
        return new SummaryStep(
            $this->getProductBundleClient(),
            $this->getShipmentService(),
            $this->getConfig(),
            $this->getStore(),
            $this->createCartItemsProductsProvider(),
            CheckoutPageControllerProvider::CHECKOUT_SUMMARY,
            HomePageControllerProvider::ROUTE_HOME
        );
    }

    /**
     * @return \Pyz\Yves\CheckoutPage\Plugin\Provider\CartItemsProductProviderInterface
     */
    public function createCartItemsProductsProvider(): CartItemsProductProviderInterface
    {
        return new CartItemsProductProvider(
            $this->getProductStorageClient()
        );
    }

    /**
     * @return \Pyz\Yves\CheckoutPage\Dependency\Client\CheckoutPageToProductStorageClientInterface
     */
    public function getProductStorageClient(): CheckoutPageToProductStorageClientInterface
    {
        return $this->getProvidedDependency(CheckoutPageDependencyProvider::CLIENT_PRODUCT_STORAGE);
    }
}
