<?php

namespace Pyz\Zed\AIImageToProductDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\AIImageToProductDataImport\Business\AIImageToProductDataImportBusinessFactory getFactory()
 * @method \Pyz\Zed\AIImageToProductDataImport\Persistence\AIImageToProductDataImportRepositoryInterface getRepository()
 */
class AIImageToProductDataImportFacade extends AbstractFacade implements AIImageToProductDataImportFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function importAIImageToProduct(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null,
    ): DataImporterReportTransfer {
        return $this->getFactory()
            ->createAIImageToProductDataImport($dataImporterConfigurationTransfer)
            ->import($dataImporterConfigurationTransfer);
    }
}
