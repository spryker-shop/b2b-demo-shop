<?php
/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\DataImport\Business\Model;

interface DataImporterPublisherInterface
{
    /**
     * @return array
     */
    public static function getImportedEntityEvents();

    /**
     * @param array $importedEntityEvents
     */
    public static function setImportedEntityEvents(array $importedEntityEvents);

    /**
     * @param array $events
     *
     * @return mixed
     */
    public static function addImportedEntityEvents(array $events);

    /**
     * void
     */
    public function triggerEvents();
}
