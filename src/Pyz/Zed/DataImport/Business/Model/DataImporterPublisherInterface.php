<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
     *
     * @return void
     */
    public static function setImportedEntityEvents(array $importedEntityEvents);

    /**
     * @param array $events
     *
     * @return mixed
     */
    public static function addImportedEntityEvents(array $events);

    /**
     * @return void
     */
    public function triggerEvents();
}
