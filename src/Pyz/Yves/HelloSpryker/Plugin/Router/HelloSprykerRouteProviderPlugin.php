<?php

namespace Pyz\Yves\HelloSpryker\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class HelloSprykerRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    protected const ROUTE_HELLO_SPRYKER_INDEX = 'hello-spryker-index';

    /**
     * Specification:
     * - Adds Routes to the RouteCollection.
     *
     * @api
     *
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addHelloSprykerIndexRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addHelloSprykerIndexRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/hello-spryker', 'HelloSpryker', 'Index', 'indexAction');
        $routeCollection->add(static::ROUTE_HELLO_SPRYKER_INDEX, $route);

        return $routeCollection;
    }
}
