<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Pyz\Zed\AntelopeDataImport\Business\Step\AntelopeWriterStep;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;

/**
 * @method \Pyz\Zed\AntelopeDataImport\AntelopeDataImportConfig getConfig()
 */
class AntelopeDataImportBusinessFactory extends DataImportBusinessFactory
{
    /**
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterInterface
     */
    public function createAntelopeDataImport(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null)
    {
        $dataImporter = $this->getCsvDataImporterFromConfig($dataImporterConfigurationTransfer);

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker->addStep(new AntelopeWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }
}
