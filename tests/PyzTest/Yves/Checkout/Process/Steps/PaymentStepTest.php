<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Yves\Checkout\Process\Steps;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\PaymentMethodTransfer;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Yves\Messenger\FlashMessenger\FlashMessengerInterface;
use Spryker\Yves\StepEngine\Dependency\Plugin\Handler\StepHandlerPluginCollection;
use Spryker\Yves\StepEngine\Dependency\Plugin\Handler\StepHandlerPluginInterface;
use SprykerShop\Yves\CheckoutPage\Dependency\Client\CheckoutPageToCalculationClientBridge;
use SprykerShop\Yves\CheckoutPage\Dependency\Client\CheckoutPageToCalculationClientInterface;
use SprykerShop\Yves\CheckoutPage\Dependency\Client\CheckoutPageToPaymentClientInterface;
use SprykerShop\Yves\CheckoutPage\Extractor\PaymentMethodKeyExtractor;
use SprykerShop\Yves\CheckoutPage\Process\Steps\PaymentStep;
use SprykerShop\Yves\CheckoutPageExtension\Dependency\Plugin\CheckoutPaymentStepEnterPreCheckPluginInterface;
use SprykerShop\Yves\QuoteApprovalWidget\Plugin\CheckoutPage\QuoteApprovalCheckerCheckoutPaymentStepEnterPreCheckPlugin;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Yves
 * @group Checkout
 * @group Process
 * @group Steps
 * @group PaymentStepTest
 * Add your own group annotations below this line
 */
class PaymentStepTest extends Unit
{
    /**
     * @return void
     */
    public function testExecuteShouldSelectPlugin(): void
    {
        $paymentPluginMock = $this->createPaymentPluginMock();
        $paymentPluginMock->expects($this->once())->method('addToDataClass');

        $paymentStepHandler = new StepHandlerPluginCollection();
        $paymentStepHandler->add($paymentPluginMock, 'test');
        $paymentStep = $this->createPaymentStep($paymentStepHandler);

        $quoteTransfer = new QuoteTransfer();

        $paymentTransfer = new PaymentTransfer();
        $paymentTransfer->setPaymentSelection('test');
        $quoteTransfer->setPayment($paymentTransfer);

        $paymentStep->execute($this->createRequest(), $quoteTransfer);
    }

    /**
     * @return void
     */
    public function testPostConditionsShouldReturnTrueWhenPaymentSet(): void
    {
        $quoteTransfer = new QuoteTransfer();
        $paymentTransfer = new PaymentTransfer();
        $paymentTransfer->setPaymentProvider('test')->setPaymentSelection('test');
        $quoteTransfer->setPayment($paymentTransfer);

        $paymentStep = $this->createPaymentStep(new StepHandlerPluginCollection());

        $this->assertTrue($paymentStep->postCondition($quoteTransfer));
    }

    /**
     * @return void
     */
    public function testShipmentRequireInputShouldReturnTrue(): void
    {
        $paymentStep = $this->createPaymentStep(new StepHandlerPluginCollection());
        $this->assertTrue($paymentStep->requireInput(new QuoteTransfer()));
    }

    /**
     * @param \Spryker\Yves\StepEngine\Dependency\Plugin\Handler\StepHandlerPluginCollection $paymentPlugins
     *
     * @return \SprykerShop\Yves\CheckoutPage\Process\Steps\PaymentStep
     */
    protected function createPaymentStep(StepHandlerPluginCollection $paymentPlugins): PaymentStep
    {
        return new PaymentStep(
            $this->getPaymentClientMock(),
            $paymentPlugins,
            'payment',
            'escape_route',
            $this->getFlashMessengerMock(),
            $this->getCalculationClientMock(),
            $this->getCheckoutPaymentStepEnterPreCheckPlugins(),
            new PaymentMethodKeyExtractor(),
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    protected function createRequest(): Request
    {
        return Request::createFromGlobals();
    }

    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Plugin\Handler\StepHandlerPluginInterface
     */
    protected function createPaymentPluginMock(): StepHandlerPluginInterface
    {
        return $this->createMock(StepHandlerPluginInterface::class);
    }

    /**
     * @return \SprykerShop\Yves\CheckoutPage\Dependency\Client\CheckoutPageToCalculationClientInterface
     */
    protected function getCalculationClientMock(): CheckoutPageToCalculationClientInterface
    {
        return $this->createMock(CheckoutPageToCalculationClientBridge::class);
    }

    /**
     * @return \Spryker\Yves\Messenger\FlashMessenger\FlashMessengerInterface
     */
    protected function getFlashMessengerMock(): FlashMessengerInterface
    {
        return $this->createMock(FlashMessengerInterface::class);
    }

    /**
     * @return \SprykerShop\Yves\CheckoutPage\Dependency\Client\CheckoutPageToPaymentClientInterface
     */
    protected function getPaymentClientMock(): CheckoutPageToPaymentClientInterface
    {
        $availablePaymentMethods = (new PaymentMethodsTransfer())
            ->addMethod(
                (new PaymentMethodTransfer())->setMethodName('test'),
            );

        $paymentClientMock = $this->createMock(CheckoutPageToPaymentClientInterface::class);
        $paymentClientMock->method('getAvailableMethods')
            ->willReturn($availablePaymentMethods);

        return $paymentClientMock;
    }

    /**
     * @return array<\SprykerShop\Yves\CheckoutPageExtension\Dependency\Plugin\CheckoutPaymentStepEnterPreCheckPluginInterface>
     */
    public function getCheckoutPaymentStepEnterPreCheckPlugins(): array
    {
        return [
            $this->getQuoteApprovalCheckerCheckoutPaymentStepEnterPreCheckPluginMock(),
        ];
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerShop\Yves\CheckoutPageExtension\Dependency\Plugin\CheckoutPaymentStepEnterPreCheckPluginInterface
     */
    protected function getQuoteApprovalCheckerCheckoutPaymentStepEnterPreCheckPluginMock(): CheckoutPaymentStepEnterPreCheckPluginInterface
    {
        return $this->getMockBuilder(QuoteApprovalCheckerCheckoutPaymentStepEnterPreCheckPlugin::class)
            ->enableProxyingToOriginalMethods()
            ->getMock();
    }
}
