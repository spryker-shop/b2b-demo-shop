<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\DataImport\Business\Model;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\EventBehavior\EventBehaviorConfig;

class DataImporterCollection extends \Spryker\Zed\DataImport\Business\Model\DataImporterCollection
{

    /**
     * @var DataImporterPublisherInterface
     */
    protected $dataImporterPublisher;

    /**
     * @param DataImporterPublisherInterface $dataImporterPublisher
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
