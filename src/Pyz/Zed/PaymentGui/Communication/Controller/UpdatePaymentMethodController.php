<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\PaymentGui\Communication\Controller;

use Generated\Shared\Transfer\PaymentMethodResponseTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPaymentMethodTypeQuery;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\PaymentGui\Communication\PaymentGuiCommunicationFactory getFactory()
 */
class UpdatePaymentMethodController extends \Spryker\Zed\PaymentGui\Communication\Controller\UpdatePaymentMethodController
{
    protected const REDIRECT_URL = '/payment-gui/payment-method/index';
    protected const MESSAGE_SUCCESS = 'Payment method has been successfully updated';
    protected const PARAMETER_ID_PAYMENT_METHOD = 'id-payment-method';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request)
    {
        $idPaymentMethod = $this->castId(
            $request->query->getInt(static::PARAMETER_ID_PAYMENT_METHOD)
        );

        $paymentMethodResponseTransfer = $this->getFactory()
            ->getPaymentFacade()
            ->findPaymentMethodById($idPaymentMethod);

        if (!$paymentMethodResponseTransfer->getIsSuccessful()) {
            $this->setErrors($paymentMethodResponseTransfer);

            return $this->redirectResponse(static::REDIRECT_URL);
        }

        $paymentMethodTabs = $this->getFactory()->createPaymentMethodTabs();
        $dataProvider = $this->getFactory()->createPaymentMethodFormDataProvider();
        /** @var \Generated\Shared\Transfer\PaymentMethodTransfer $paymentMethodTransfer */
        $paymentMethodTransfer = $paymentMethodResponseTransfer->requirePaymentMethod()
            ->getPaymentMethod();
        $paymentMethodForm = $this->getFactory()
            ->createPaymentMethodForm(
                $dataProvider->getData($paymentMethodTransfer),
                $dataProvider->getOptions()
            );
        $paymentMethodForm->handleRequest($request);

        if ($paymentMethodForm->isSubmitted() && $paymentMethodForm->isValid()) {
            $process = $request->get('process');
            $defaultPaymentMethod = SpySalesPaymentMethodTypeQuery::create()->findByPaymentMethod("invoice")->get(0);
            $defaultPaymentMethod->setOmsProcessName($process);
            $defaultPaymentMethod->save();

            return $this->handlePaymentMethodForm($paymentMethodForm);
        }

        $defaultPaymentMethod = SpySalesPaymentMethodTypeQuery::create()->findByPaymentMethod("invoice")->get(0);
        $defaultProcessName =  $defaultPaymentMethod->getOmsProcessName();
        $paymentMethodTransfer->setDefaultProcess($defaultProcessName);

        return $this->viewResponse([
            'paymentMethodForm' => $paymentMethodForm->createView(),
            'paymentMethodTabs' => $paymentMethodTabs->createView(),
            'paymentMethod' => $paymentMethodTransfer,
        ]);
    }

    /**
     * @param \Generated\Shared\Transfer\PaymentMethodResponseTransfer $paymentMethodResponseTransfer
     *
     * @return void
     */
    protected function setErrors(PaymentMethodResponseTransfer $paymentMethodResponseTransfer): void
    {
        foreach ($paymentMethodResponseTransfer->getMessages() as $messageTransfer) {
            $messageText = $messageTransfer->getValue();

            if ($messageText === null) {
                continue;
            }

            $this->addErrorMessage($messageText);
        }
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $paymentMethodForm
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function handlePaymentMethodForm(FormInterface $paymentMethodForm): RedirectResponse
    {
        $paymentMethodResponseTransfer = $this->getFactory()
            ->getPaymentFacade()
            ->updatePaymentMethod($paymentMethodForm->getData());

        if (!$paymentMethodResponseTransfer->getIsSuccessful()) {
            $this->setErrors($paymentMethodResponseTransfer);

            return $this->redirectResponse(static::REDIRECT_URL);
        }

        $this->addSuccessMessage(static::MESSAGE_SUCCESS);

        return $this->redirectResponse(static::REDIRECT_URL);
    }
}
