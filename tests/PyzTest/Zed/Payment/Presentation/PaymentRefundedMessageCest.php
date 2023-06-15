<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\Payment\Presentation;

use Generated\Shared\Transfer\PaymentRefundedTransfer;
use PyzTest\Zed\Payment\PaymentTester;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group Payment
 * @group Presentation
 * @group PaymentRefundedMessageCest
 * Add your own group annotations below this line
 */
class PaymentRefundedMessageCest
{
    /**
     * @var string
     */
    protected const INITIAL_ITEM_STATE = 'payment refund pending';

    /**
     * @var string
     */
    public const FINAL_ITEM_STATE = 'payment refunded';

    /**
     * @param \PyzTest\Zed\Payment\PaymentTester $I
     *
     * @return void
     */
    public function testPaymentReservationCanceledMessageIsSuccessfullyHandled(PaymentTester $I): void
    {
        // Arrange
        $salesOrderEntity = $I->haveSalesOrder(static::INITIAL_ITEM_STATE);
        $paymentRefundedTransfer = $I->havePaymentMessageTransfer(
            PaymentRefundedTransfer::class,
            $salesOrderEntity,
        );

        // Act
        $I->handlePaymentMessageTransfer($paymentRefundedTransfer);

        // Assert
        $I->assertOrderHasCorrectState($salesOrderEntity, static::FINAL_ITEM_STATE);
    }
}
