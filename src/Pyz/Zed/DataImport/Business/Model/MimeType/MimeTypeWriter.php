<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\MimeType;

use Orm\Zed\FileManager\Persistence\SpyMimeTypeQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class MimeTypeWriter implements DataImportStepInterface
{
    public const BULK_SIZE = 100;

    protected const KEY_NAME = 'name';
    protected const KEY_IS_ALLOWED = 'is_allowed';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $mimeTypeEntity = SpyMimeTypeQuery::create()
            ->filterByName($dataSet[static::KEY_NAME])
            ->findOneOrCreate();

        $mimeTypeEntity->setIsAllowed($dataSet[static::KEY_IS_ALLOWED]);

        $mimeTypeEntity->save();
    }
}
