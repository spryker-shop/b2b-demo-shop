<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\DataImport\Business\Model\DataImportStep;


use Pyz\Zed\DataImport\Business\Model\DataImporterPublisher;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepAfterExecuteInterface;

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
     * @param int $id
     *
     * @return void
     */
    public function addPublishEvents($eventName, $id)
    {
        $this->entityEvents[$eventName][] = $id;
    }
}
