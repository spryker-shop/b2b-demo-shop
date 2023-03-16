<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\Console;

use Spryker\Glue\Console\ConsoleDependencyProvider as SprykerConsoleDependencyProvider;
use Spryker\Glue\DocumentationGeneratorApi\Plugin\Console\ApiGenerateDocumentationConsole;
use Spryker\Glue\GlueApplication\Plugin\Console\ControllerCacheCollectorConsole;
use Spryker\Glue\GlueApplication\Plugin\Console\RouterCacheWarmUpConsole;
use Spryker\Glue\GlueApplication\Plugin\Console\RouterDebugGlueApplicationConsole;
use Spryker\Glue\Kernel\Container;

class ConsoleDependencyProvider extends SprykerConsoleDependencyProvider
{
    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return array<\Symfony\Component\Console\Command\Command>
     */
    protected function getConsoleCommands(Container $container): array
    {
        return [
            new ApiGenerateDocumentationConsole(),
            new ControllerCacheCollectorConsole(),
            new RouterDebugGlueApplicationConsole(),
            new RouterCacheWarmUpConsole(),
        ];
    }
}
