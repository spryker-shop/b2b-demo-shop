<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\ServicePointSearch;

use Spryker\Zed\ServicePointSearch\ServicePointSearchDependencyProvider as SprykerServicePointSearchDependencyProvider;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\ServicePointSearch\CoordinatesServicePointSearchDataExpanderPlugin;

class ServicePointSearchDependencyProvider extends SprykerServicePointSearchDependencyProvider
{
    /**
     * @return list<\Spryker\Zed\ServicePointSearchExtension\Dependency\Plugin\ServicePointSearchDataExpanderPluginInterface>
     */
    protected function getServicePointSearchDataExpanderPlugins(): array
    {
        return [
            new CoordinatesServicePointSearchDataExpanderPlugin(),
        ];
    }
}
