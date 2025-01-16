<?php



declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\DataSet;

use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

interface DataSetConditionInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return bool
     */
    public function hasData(DataSetInterface $dataSet): bool;
}
