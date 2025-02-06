<?php

namespace Pyz\Yves\TestModule\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class TestModuleRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    public const ROUTE_NAME_TESTMODULE_INDEX = 'test-module-index';

    /**
     * {@inheritDoc}
     * - Adds TestModule route to the RouteCollection.
     *
     * @api
     *
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addTestModuleRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addTestModuleRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/test-module', 'TestModule', 'Index', 'indexAction');
        $routeCollection->add(static::ROUTE_NAME_TESTMODULE_INDEX, $route);

        return $routeCollection;
    }
}
