<?php

namespace Pyz\Yves\GreenCreditsPage\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class GreenCreditsRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    protected const ROUTE_NAME_CUSTOMER_GREENCREDITS = 'customer/greencredits';

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
        $routeCollection = $this->addGreenCreditsRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addGreenCreditsRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/customer/greencredits', 'GreenCreditsPage', 'Index', 'indexAction');
        $routeCollection->add(static::ROUTE_NAME_CUSTOMER_GREENCREDITS, $route);

        return $routeCollection;
    }
}
