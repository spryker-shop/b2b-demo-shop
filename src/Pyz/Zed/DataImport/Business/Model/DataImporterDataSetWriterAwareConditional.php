<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model;

use Generated\Shared\Transfer\DataImporterReportTransfer;
use Pyz\Zed\DataImport\Business\Model\DataSet\DataSetConditionInterface;
use Spryker\Zed\DataImport\Business\Model\DataImporterDataSetWriterAware;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class DataImporterDataSetWriterAwareConditional extends DataImporterDataSetWriterAware
{
    /**
     * @var \Pyz\Zed\DataImport\Business\Model\DataSet\DataSetConditionInterface
     */
    protected $dataSetCondition;

    /**
     * @param \Pyz\Zed\DataImport\Business\Model\DataSet\DataSetConditionInterface $dataSetCondition
     *
     * @return void
     */
    public function setDataSetCondition(DataSetConditionInterface $dataSetCondition)
    {
        $this->dataSetCondition = $dataSetCondition;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     * @param \Generated\Shared\Transfer\DataImporterReportTransfer $dataImporterReportTransfer
     *
     * @return void
     */
    protected function processDataSet(DataSetInterface $dataSet, DataImporterReportTransfer $dataImporterReportTransfer): void
    {
        if ($this->dataSetCondition->hasData($dataSet)) {
            parent::processDataSet($dataSet, $dataImporterReportTransfer);
        } else {
            $dataImporterReportTransfer->setExpectedImportableDataSetCount($dataImporterReportTransfer->getExpectedImportableDataSetCount() - 1);
        }
    }
}
