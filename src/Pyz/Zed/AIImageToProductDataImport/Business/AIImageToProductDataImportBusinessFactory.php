<?php

namespace Pyz\Zed\AIImageToProductDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Pyz\Zed\AIImageToProductDataImport\Business\DataImportStep\AIImageToProductWriterStep;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;

/**
 * @method \Pyz\Zed\AIImageToProductDataImport\Persistence\AIImageToProductDataImportRepositoryInterface getRepository()
 * @method \Pyz\Zed\AIImageToProductDataImport\AIImageToProductDataImportConfig getConfig()
 */
class AIImageToProductDataImportBusinessFactory extends DataImportBusinessFactory
{
    /**
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterInterface
     */
    public function createAIImageToProductDataImport(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null,
    ): DataImporterInterface {
        $dataImporter = $this->getCsvDataImporterFromConfig($dataImporterConfigurationTransfer);

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker->addStep($this->createAIImageToProductWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    /**
     * @return \Pyz\Zed\AIImageToProductDataImport\Business\DataImportStep\AIImageToProductWriterStep
     */
    public function createAIImageToProductWriterStep(): AIImageToProductWriterStep
    {
        return new AIImageToProductWriterStep();
    }
}
