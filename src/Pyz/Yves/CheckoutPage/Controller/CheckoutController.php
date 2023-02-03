<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CheckoutPage\Controller;

use ArrayObject;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;
use SprykerShop\Yves\CheckoutPage\Controller\CheckoutController as SprykerCheckoutController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Yves\CheckoutPage\CheckoutPageFactory getFactory()
 * @method \Spryker\Client\Checkout\CheckoutClientInterface getClient()
 */
class CheckoutController extends SprykerCheckoutController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Spryker\Yves\Kernel\View\View
     */
    public function customerAction(Request $request)
    {
        $quoteValidationResponseTransfer = $this->canPyzProceedCheckout();

        if (!$quoteValidationResponseTransfer->getIsSuccessful()) {
            $this->processPyzErrorMessages($quoteValidationResponseTransfer->getMessages());

            return $this->redirectResponseInternal(static::ROUTE_CART);
        }

        $response = $this->getFactory()->createCheckoutProcess()->process(
            $request,
            $this->getFactory()
                ->createPyzCheckoutFormFactory()
                ->createCustomerFormCollection(),
        );

        if (!is_array($response)) {
            return $response;
        }

        return $this->view(
            $response,
            $this->getFactory()->getCustomerPageWidgetPlugins(),
            '@CheckoutPage/views/login/login.twig',
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Spryker\Yves\Kernel\View\View
     */
    public function addressAction(Request $request)
    {
        $quoteValidationResponseTransfer = $this->canPyzProceedCheckout();

        if (!$quoteValidationResponseTransfer->getIsSuccessful()) {
            $this->processPyzErrorMessages($quoteValidationResponseTransfer->getMessages());

            return $this->redirectResponseInternal(static::ROUTE_CART);
        }

        $response = $this->getFactory()->createCheckoutProcess()->process(
            $request,
            $this->getFactory()
                ->createPyzCheckoutFormFactory()
                ->createAddressFormCollection(),
        );

        if (!is_array($response)) {
            return $response;
        }

        return $this->view(
            $response,
            $this->getFactory()->getCustomerPageWidgetPlugins(),
            '@CheckoutPage/views/address/address.twig',
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Spryker\Yves\Kernel\View\View
     */
    public function shipmentAction(Request $request)
    {
        $quoteValidationResponseTransfer = $this->canPyzProceedCheckout();

        if (!$quoteValidationResponseTransfer->getIsSuccessful()) {
            $this->processPyzErrorMessages($quoteValidationResponseTransfer->getMessages());

            return $this->redirectResponseInternal(static::ROUTE_CART);
        }

        $response = $this->getFactory()->createCheckoutProcess()->process(
            $request,
            $this->getFactory()
                ->createPyzCheckoutFormFactory()
                ->createShipmentFormCollection(),
        );

        if (!is_array($response)) {
            return $response;
        }

        return $this->view(
            $response,
            $this->getFactory()->getCustomerPageWidgetPlugins(),
            '@CheckoutPage/views/shipment/shipment.twig',
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Spryker\Yves\Kernel\View\View
     */
    public function paymentAction(Request $request)
    {
        $quoteValidationResponseTransfer = $this->canPyzProceedCheckout();

        if (!$quoteValidationResponseTransfer->getIsSuccessful()) {
            $this->processPyzErrorMessages($quoteValidationResponseTransfer->getMessages());

            return $this->redirectResponseInternal(static::ROUTE_CART);
        }

        $response = $this->getFactory()->createCheckoutProcess()->process(
            $request,
            $this->getFactory()
                ->createPyzCheckoutFormFactory()
                ->getPyzPaymentFormCollection(),
        );

        if (!is_array($response)) {
            return $response;
        }

        return $this->view(
            $response,
            $this->getFactory()->getCustomerPageWidgetPlugins(),
            '@CheckoutPage/views/payment/payment.twig',
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Spryker\Yves\Kernel\View\View
     */
    public function summaryAction(Request $request)
    {
        $quoteValidationResponseTransfer = $this->canPyzProceedCheckout();

        if (!$quoteValidationResponseTransfer->getIsSuccessful()) {
            $this->processPyzErrorMessages($quoteValidationResponseTransfer->getMessages());

            return $this->redirectResponseInternal(static::ROUTE_CART);
        }

        $viewData = $this->getFactory()->createCheckoutProcess()->process(
            $request,
            $this->getFactory()
                ->createPyzCheckoutFormFactory()
                ->createSummaryFormCollection(),
        );

        if (!is_array($viewData)) {
            return $viewData;
        }

        return $this->view(
            $viewData,
            $this->getFactory()->getSummaryPageWidgetPlugins(),
            '@CheckoutPage/views/summary/summary.twig',
        );
    }

    /**
     * @return \Generated\Shared\Transfer\QuoteValidationResponseTransfer
     */
    protected function canPyzProceedCheckout(): QuoteValidationResponseTransfer
    {
        $quoteTransfer = $this->getFactory()
            ->getQuoteClient()
            ->getQuote();

        return $this->getFactory()
            ->getCheckoutClient()
            ->isQuoteApplicableForCheckout($quoteTransfer);
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\MessageTransfer> $messageTransfers
     *
     * @return void
     */
    protected function processPyzErrorMessages(ArrayObject $messageTransfers): void
    {
        foreach ($messageTransfers as $messageTransfer) {
            $this->addErrorMessage($messageTransfer->getValue());
        }
    }
}
