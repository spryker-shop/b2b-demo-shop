<?php

namespace Pyz\Zed\AIImageToProductDataImport\Communication\Plugin\DataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Pyz\Zed\AIImageToProductDataImport\AIImageToProductDataImportConfig;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\AIImageToProductDataImport\Business\AIImageToProductDataImportFacadeInterface getFacade()
 * @method \Pyz\Zed\AIImageToProductDataImport\AIImageToProductDataImportConfig getConfig()
 */
class AIImageToProductDataImportPlugin extends AbstractPlugin implements DataImportPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null,
    ): DataImporterReportTransfer {
        return $this->getFacade()->importAIImageToProduct($dataImporterConfigurationTransfer);
    }

    /**
     * @return string
     */
    public function getImportType(): string
    {
        return AIImageToProductDataImportConfig::IMPORT_TYPE_AI_IMAGE_TO_PRODUCT;
    }
}
