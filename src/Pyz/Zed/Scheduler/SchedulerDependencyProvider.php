<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\Scheduler;

use Pyz\Shared\Scheduler\SchedulerConfig;
use Spryker\Zed\Scheduler\Communication\Plugin\Scheduler\PhpScheduleReaderPlugin;
use Spryker\Zed\Scheduler\SchedulerDependencyProvider as SprykerSchedulerDependencyProvider;
use Spryker\Zed\SchedulerJenkins\Communication\Plugin\Adapter\SchedulerJenkinsAdapterPlugin;

class SchedulerDependencyProvider extends SprykerSchedulerDependencyProvider
{
    /**
     * @return array<\Spryker\Zed\SchedulerExtension\Dependency\Plugin\ScheduleReaderPluginInterface>
     */
    protected function getScheduleReaderPlugins(): array
    {
        return [
            new PhpScheduleReaderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Zed\SchedulerExtension\Dependency\Plugin\SchedulerAdapterPluginInterface>
     */
    protected function getSchedulerAdapterPlugins(): array
    {
        return [
            SchedulerConfig::SCHEDULER_JENKINS => new SchedulerJenkinsAdapterPlugin(),
        ];
    }
}
