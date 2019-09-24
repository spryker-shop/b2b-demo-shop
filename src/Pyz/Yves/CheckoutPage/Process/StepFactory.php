<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CheckoutPage\Process;

use Pyz\Yves\CheckoutPage\Process\Steps\ShipmentStep;
use SprykerShop\Yves\CheckoutPage\Plugin\Provider\CheckoutPageControllerProvider;
use SprykerShop\Yves\CheckoutPage\Process\StepFactory as SprykerStepFactory;
use SprykerShop\Yves\HomePage\Plugin\Provider\HomePageControllerProvider;

class StepFactory extends SprykerStepFactory
{
    /**
     * @return \SprykerShop\Yves\CheckoutPage\Process\Steps\ShipmentStep
     */
    public function createShipmentStep()
    {
        return new ShipmentStep(
            $this->getCalculationClient(),
            $this->getShipmentPlugins(),
            $this->createShipmentStepPostConditionChecker(),
            $this->createGiftCardItemsChecker(),
            $this->getStore(),
            CheckoutPageControllerProvider::CHECKOUT_SHIPMENT,
            HomePageControllerProvider::ROUTE_HOME
        );
    }
}
