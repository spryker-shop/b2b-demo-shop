<?php



declare(strict_types = 1);

namespace Pyz\Zed\StateMachine;

use Pyz\Zed\ExampleStateMachine\Communication\Plugin\TestStateMachineHandlerPlugin;
use Spryker\Zed\StateMachine\StateMachineDependencyProvider as SprykerStateMachineDependencyProvider;

class StateMachineDependencyProvider extends SprykerStateMachineDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\StateMachine\Dependency\Plugin\StateMachineHandlerInterface>
     */
    protected function getStateMachineHandlers(): array
    {
        return [
            new TestStateMachineHandlerPlugin(),
        ];
    }
}
