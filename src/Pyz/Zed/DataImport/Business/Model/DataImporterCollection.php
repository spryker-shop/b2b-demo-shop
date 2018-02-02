<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\DataImport\Business\Model\DataImporterCollection as SprykerDataImporterCollection;
use Spryker\Zed\EventBehavior\EventBehaviorConfig;

class DataImporterCollection extends SprykerDataImporterCollection
{
    /**
     * @var \Pyz\Zed\DataImport\Business\Model\DataImporterPublisherInterface
     */
    protected $dataImporterPublisher;

    /**
     * @param \Pyz\Zed\DataImport\Business\Model\DataImporterPublisherInterface $dataImporterPublisher
     */
    public function __construct(DataImporterPublisherInterface $dataImporterPublisher)
    {
        $this->dataImporterPublisher = $dataImporterPublisher;
    }

    /**
     * {@inheritdoc}
     *
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null)
    {
        $importType = $this->getCurrentImportType($dataImporterConfigurationTransfer);
        $dataImporterReportTransfer = $this->prepareDataImporterReport($importType);

        EventBehaviorConfig::disableEvent();

        if ($importType !== $this->getImportType()) {
            $this->executeDataImporter(
                $this->dataImporter[$importType],
                $dataImporterReportTransfer,
                $dataImporterConfigurationTransfer
            );

            EventBehaviorConfig::enableEvent();
            $this->dataImporterPublisher->triggerEvents();

            return $dataImporterReportTransfer;
        }

        foreach ($this->dataImporter as $dataImporter) {
            $this->executeDataImporter(
                $dataImporter,
                $dataImporterReportTransfer,
                $dataImporterConfigurationTransfer
            );
        }

        EventBehaviorConfig::enableEvent();
        $this->dataImporterPublisher->triggerEvents();

        return $dataImporterReportTransfer;
    }
}
