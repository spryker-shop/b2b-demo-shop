<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace PyzTest\Zed\MessageBroker\MessageHandlers\Payment\Presentation;

use Generated\Shared\Transfer\PaymentCapturedTransfer;
use PyzTest\Zed\MessageBroker\PaymentPresentationTester;

/**
 * Auto-generated group annotations
 *
 * @group PyzTest
 * @group Zed
 * @group MessageBroker
 * @group MessageHandlers
 * @group Payment
 * @group Presentation
 * @group PaymentCapturedMessageCest
 * Add your own group annotations below this line
 */
class PaymentCapturedMessageCest
{
    protected const INITIAL_ITEM_STATE = 'payment capture pending';

    protected const INITIAL_ITEM_STATE_AFTER_AUTHORIZATION = 'payment capture pending';

    public const FINAL_ITEM_STATE = 'payment captured';

    public function _before(PaymentPresentationTester $i): void
    {
        $i->amZed();
        $i->amLoggedInUser();
    }

    public function testPaymentCapturedMessageIsSuccessfullyHandled(PaymentPresentationTester $I): void
    {
        // Arrange
        $salesOrderEntity = $I->haveSalesOrder(static::INITIAL_ITEM_STATE);
        $paymentCapturedTransfer = $I->havePaymentMessageTransfer(
            PaymentCapturedTransfer::class,
            $salesOrderEntity,
        );

        // Act
        $I->handlePaymentMessageTransfer($paymentCapturedTransfer);

        // Assert
        $I->assertOrderHasCorrectState($salesOrderEntity, static::FINAL_ITEM_STATE);
    }

    public function testPaymentCapturedMessageIsSuccessfullyHandledWhenItemWasAuthorized(PaymentPresentationTester $I): void
    {
        // Arrange
        $salesOrderEntity = $I->haveSalesOrder(static::INITIAL_ITEM_STATE_AFTER_AUTHORIZATION);
        $paymentCapturedTransfer = $I->havePaymentMessageTransfer(
            PaymentCapturedTransfer::class,
            $salesOrderEntity,
        );

        // Act
        $I->handlePaymentMessageTransfer($paymentCapturedTransfer);

        // Assert
        $I->assertOrderHasCorrectState($salesOrderEntity, static::FINAL_ITEM_STATE);
    }
}
