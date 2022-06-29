<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeDataImport\Communication\Plugin\DataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Pyz\Zed\AntelopeDataImport\AntelopeDataImportConfig;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\AntelopeDataImport\Business\AntelopeDataImportFacadeInterface getFacade()
 * @method \Pyz\Zed\AntelopeDataImport\AntelopeDataImportConfig getConfig()
 */
class AntelopeDataImportPlugin extends AbstractPlugin implements DataImportPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null)
    {
        return $this->getFacade()->importAntelope($dataImporterConfigurationTransfer);
    }

    /**
     * @return string
     */
    public function getImportType()
    {
        return AntelopeDataImportConfig::IMPORT_TYPE_ANTELOPE;
    }
}
