<?php

namespace Pyz\Zed\TestModule\Communication\Table;

use Orm\Zed\TestModule\Persistence\Map\PyzCarsTableMap;
use Orm\Zed\TestModule\Persistence\PyzCarsQuery;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class PyzCarsTable extends AbstractTable
{
    protected PyzCarsQuery $carsQuery;

    public function __construct(PyzCarsQuery $carsQuery)
    {
        $this->carsQuery = $carsQuery;
    }

    /**
     * Configures table headers, sorting, and filtering.
     *
     * @param TableConfiguration $config
     * @return TableConfiguration
     */
    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config->setHeader([
            PyzCarsTableMap::COL_ID => 'ID',
            PyzCarsTableMap::COL_NAME => 'Name',
            PyzCarsTableMap::COL_ENGINE => 'Engine',
            'actions' => 'Actions',
        ]);

        $config->setSortable([
            PyzCarsTableMap::COL_ID,
            PyzCarsTableMap::COL_NAME,
        ]);

        $config->setSearchable([
            PyzCarsTableMap::COL_NAME,
            PyzCarsTableMap::COL_ENGINE,
        ]);

        return $config;
    }

    /**
     * Fetches data from the database.
     *
     * @param TableConfiguration $config
     * @return array
     */
    protected function prepareData(TableConfiguration $config): array
    {
        return $this->runQuery($this->carsQuery, $config);
    }
}
