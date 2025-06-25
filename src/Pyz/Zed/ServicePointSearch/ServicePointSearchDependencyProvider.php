<?php

namespace Pyz\Zed\ServicePointSearch;

use Spryker\Zed\ServicePointSearch\ServicePointSearchDependencyProvider as SprykerServicePointSearchDependencyProvider;
use SprykerFeature\Zed\SelfServicePortal\Communication\Plugin\ServicePointSearch\CoordinatesServicePointSearchDataExpanderPlugin;

class ServicePointSearchDependencyProvider extends SprykerServicePointSearchDependencyProvider
{
    protected function getServicePointSearchDataExpanderPlugins(): array
    {
        return [
            new CoordinatesServicePointSearchDataExpanderPlugin(),
        ];
    }
}
