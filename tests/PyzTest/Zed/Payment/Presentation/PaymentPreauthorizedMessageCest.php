<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\Payment\Presentation;

use Generated\Shared\Transfer\PaymentPreauthorizedTransfer;
use PyzTest\Zed\Payment\PaymentTester;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group Payment
 * @group Presentation
 * @group PaymentPreauthorizedMessageCest
 * Add your own group annotations below this line
 */
class PaymentPreauthorizedMessageCest
{
    /**
     * @var string
     */
    protected const INITIAL_ITEM_STATE = 'payment authorization pending';

    /**
     * @var string
     */
    public const FINAL_ITEM_STATE = 'payment authorized';

    /**
     * @param \PyzTest\Zed\Payment\PaymentTester $I
     *
     * @return void
     */
    public function testPaymentPreauthorizedMessageIsSuccessfullyHandled(PaymentTester $I): void
    {
        // Arrange
        $salesOrderEntity = $I->haveSalesOrder(static::INITIAL_ITEM_STATE);
        $paymentPreauthorizedTransfer = $I->havePaymentMessageTransfer(
            PaymentPreauthorizedTransfer::class,
            $salesOrderEntity,
        );

        // Act
        $I->handlePaymentMessageTransfer($paymentPreauthorizedTransfer);

        // Assert
        $I->assertOrderHasCorrectState($salesOrderEntity, static::FINAL_ITEM_STATE);
    }
}
