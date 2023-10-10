<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace PyzTest\Zed\MessageBroker;

use Codeception\Actor;
use Generated\Shared\DataBuilder\InitializeProductExportBuilder;
use Generated\Shared\Transfer\InitializeProductExportTransfer;

/**
 * Inherited Methods
 *
 * @method void wantTo($text)
 * @method void wantToTest($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause($vars = [])
 *
 * @SuppressWarnings(\PyzTest\Zed\MessageBroker\PHPMD)
 */
class ProductCommunicationTester extends Actor
{
    use _generated\ProductCommunicationTesterActions;

    /**
     * @param array<string, mixed> $messageAttributeSeedData
     *
     * @return \Generated\Shared\Transfer\InitializeProductExportTransfer
     */
    public function buildInitializeProductExportTransfer(array $messageAttributeSeedData = []): InitializeProductExportTransfer
    {
        return (new InitializeProductExportBuilder())
            ->withMessageAttributes($messageAttributeSeedData)
            ->build();
    }
}
