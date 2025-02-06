<?php

namespace Pyz\Zed\TestModule\Communication;

use Orm\Zed\TestModule\Persistence\PyzCarsQuery;
use Pyz\Zed\TestModule\Communication\Table\PyzCarsTable;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \Pyz\Zed\TestModule\Persistence\TestModuleQueryContainer getQueryContainer()
 * @method \Pyz\Zed\TestModule\TestModuleConfig getConfig()
 */
class TestModuleCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * Creates a table instance for displaying pyz_cars data.
     *
     * @return \Pyz\Zed\TestModule\Communication\Table\PyzCarsTable
     */
    public function createPyzCarsTable(): PyzCarsTable
    {
        return new PyzCarsTable(PyzCarsQuery::create());
    }
}
