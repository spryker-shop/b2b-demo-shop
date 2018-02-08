<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\DataImportStep;

use Pyz\Zed\DataImport\Business\Model\DataImporterPublisher;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepAfterExecuteInterface;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
class PublishAwareStep implements DataImportStepAfterExecuteInterface
{
    /**
     * @var array
     */
    protected $entityEvents = [];

    /**
     * @return void
     */
    public function afterExecute()
    {
        DataImporterPublisher::addImportedEntityEvents($this->entityEvents);
    }

    /**
     * @param string $eventName
     * @param int $entityId
     *
     * @return void
     */
    public function addPublishEvents($eventName, $entityId)
    {
        $this->entityEvents[$eventName][] = $entityId;
    }
}
