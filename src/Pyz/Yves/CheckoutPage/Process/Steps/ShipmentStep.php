<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CheckoutPage\Process\Steps;

use Pyz\Yves\CheckoutPage\Process\DataProviders\CartItemsProductProviderInterface;
use Spryker\Shared\Kernel\Store;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\Plugin\Handler\StepHandlerPluginCollection;
use SprykerShop\Yves\CheckoutPage\Dependency\Client\CheckoutPageToCalculationClientInterface;
use SprykerShop\Yves\CheckoutPage\GiftCard\GiftCardItemsCheckerInterface;
use SprykerShop\Yves\CheckoutPage\Process\Steps\PostConditionCheckerInterface;
use SprykerShop\Yves\CheckoutPage\Process\Steps\ShipmentStep as SprykerShopShipmentStep;

class ShipmentStep extends SprykerShopShipmentStep
{
    /**
     * @var \Spryker\Shared\Kernel\Store
     */
    protected $store;

    /**
     * @var \Pyz\Yves\CheckoutPage\Process\DataProviders\CartItemsProductProviderInterface
     */
    protected $cartItemsProductsProvider;

    /**
     * @param \SprykerShop\Yves\CheckoutPage\Dependency\Client\CheckoutPageToCalculationClientInterface $calculationClient
     * @param \Spryker\Yves\StepEngine\Dependency\Plugin\Handler\StepHandlerPluginCollection $shipmentPlugins
     * @param \SprykerShop\Yves\CheckoutPage\Process\Steps\PostConditionCheckerInterface $postConditionChecker
     * @param \SprykerShop\Yves\CheckoutPage\GiftCard\GiftCardItemsCheckerInterface $giftCardItemsChecker
     * @param \Spryker\Shared\Kernel\Store $store
     * @param \Pyz\Yves\CheckoutPage\Process\DataProviders\CartItemsProductProviderInterface $cartItemsProductsProvider
     * @param string $stepRoute
     * @param string $escapeRoute
     */
    public function __construct(
        CheckoutPageToCalculationClientInterface $calculationClient,
        StepHandlerPluginCollection $shipmentPlugins,
        PostConditionCheckerInterface $postConditionChecker,
        GiftCardItemsCheckerInterface $giftCardItemsChecker,
        Store $store,
        CartItemsProductProviderInterface $cartItemsProductsProvider,
        $stepRoute,
        $escapeRoute
    ) {
        parent::__construct(
            $calculationClient,
            $shipmentPlugins,
            $postConditionChecker,
            $giftCardItemsChecker,
            $stepRoute,
            $escapeRoute
        );

        $this->store = $store;
        $this->cartItemsProductsProvider = $cartItemsProductsProvider;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array
     */
    public function getTemplateVariables(AbstractTransfer $quoteTransfer)
    {
        $templateVariables = parent::getTemplateVariables($quoteTransfer);

        return $templateVariables + [
            'currentLanguage' => $this->store->getCurrentLanguage(),
            'products' => $this->cartItemsProductsProvider->getItemsProducts(
                $this->getCartItems($quoteTransfer),
                $this->store->getCurrentLocale()
            ),
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array
     */
    protected function getCartItems(AbstractTransfer $quoteTransfer): array
    {
        return $quoteTransfer->getItems()->getArrayCopy();
    }
}
