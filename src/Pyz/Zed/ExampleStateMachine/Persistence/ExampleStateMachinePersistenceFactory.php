<?php



declare(strict_types = 1);

namespace Pyz\Zed\ExampleStateMachine\Persistence;

use Orm\Zed\ExampleStateMachine\Persistence\PyzExampleStateMachineItemQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Pyz\Zed\ExampleStateMachine\Persistence\ExampleStateMachineQueryContainerInterface getQueryContainer()
 */
class ExampleStateMachinePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ExampleStateMachine\Persistence\PyzExampleStateMachineItemQuery
     */
    public function createExampleStateMachineQuery(): PyzExampleStateMachineItemQuery
    {
        return PyzExampleStateMachineItemQuery::create();
    }
}
