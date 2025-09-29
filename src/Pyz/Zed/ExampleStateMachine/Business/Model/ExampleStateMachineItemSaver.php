<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ExampleStateMachine\Business\Model;

use Generated\Shared\Transfer\StateMachineItemTransfer;
use Orm\Zed\ExampleStateMachine\Persistence\PyzExampleStateMachineItem;
use Pyz\Zed\ExampleStateMachine\Persistence\ExampleStateMachineQueryContainerInterface;

class ExampleStateMachineItemSaver
{
    protected ExampleStateMachineQueryContainerInterface $exampleStateMachineQueryContainer;

    public function __construct(ExampleStateMachineQueryContainerInterface $exampleStateMachineQueryContainer)
    {
        $this->exampleStateMachineQueryContainer = $exampleStateMachineQueryContainer;
    }

    public function itemStateUpdate(StateMachineItemTransfer $stateMachineItemTransfer): bool
    {
        $exampleStateMachineItemEntity = $this->exampleStateMachineQueryContainer
            ->queryExampleStateMachineItemByIdStateMachineItem($stateMachineItemTransfer->getIdentifier())
            ->findOne();

        $exampleStateMachineItemEntity->setFkStateMachineItemState($stateMachineItemTransfer->getIdItemState());
        $affectedRowCount = $exampleStateMachineItemEntity->save();

        return $affectedRowCount > 0;
    }

    public function createExampleItem(): bool
    {
        $exampleStateMachineItemEntity = new PyzExampleStateMachineItem();
        $exampleStateMachineItemEntity->setName('Test item ' . rand(123, 321));

        $affectedRowCount = $exampleStateMachineItemEntity->save();

        return $affectedRowCount > 0;
    }
}
