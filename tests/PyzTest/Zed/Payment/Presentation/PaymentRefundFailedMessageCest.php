<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Zed\Payment\Presentation;

use Generated\Shared\Transfer\PaymentRefundFailedTransfer;
use PyzTest\Zed\Payment\PaymentTester;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group Payment
 * @group Presentation
 * @group PaymentRefundFailedMessageCest
 * Add your own group annotations below this line
 */
class PaymentRefundFailedMessageCest
{
    /**
     * @var string
     */
    protected const INITIAL_ITEM_STATE = 'payment refund pending';

    /**
     * @var string
     */
    public const FINAL_ITEM_STATE = 'payment refund failed';

    /**
     * @param \PyzTest\Zed\Payment\PaymentTester $I
     *
     * @return void
     */
    public function testPaymentReservationCanceledMessageIsSuccessfullyHandled(PaymentTester $I): void
    {
        // Arrange
        $salesOrderEntity = $I->haveSalesOrder(static::INITIAL_ITEM_STATE);
        $paymentRefundFailedTransfer = $I->havePaymentMessageTransfer(
            PaymentRefundFailedTransfer::class,
            $salesOrderEntity,
        );

        // Act
        $I->handlePaymentMessageTransfer($paymentRefundFailedTransfer);

        // Assert
        $I->assertOrderHasCorrectState($salesOrderEntity, static::FINAL_ITEM_STATE);
    }
}
