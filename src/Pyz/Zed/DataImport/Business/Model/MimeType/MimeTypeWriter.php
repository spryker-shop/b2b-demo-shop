<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\MimeType;

use Orm\Zed\FileManager\Persistence\SpyMimeType;
use Orm\Zed\FileManager\Persistence\SpyMimeTypeQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class MimeTypeWriter extends PublishAwareStep implements DataImportStepInterface
{
    const BULK_SIZE = 100;

    const KEY_NAME = 'name';
    const KEY_IS_ALLOWED = 'is_allowed';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $mimeTypeEntity = SpyMimeTypeQuery::create()->findOneByName($dataSet[static::KEY_NAME]);

        if ($mimeTypeEntity !== null) {
            return;
        }

        $this->createMimeTypeEntityFromDataset($dataSet)->save();
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyMimeType
     */
    protected function createMimeTypeEntityFromDataset(DataSetInterface $dataSet)
    {
        $mimeTypeEntity = new SpyMimeType();
        $mimeTypeEntity->setName($dataSet[static::KEY_NAME]);
        $mimeTypeEntity->setIsAllowed($dataSet[static::KEY_IS_ALLOWED]);

        return $mimeTypeEntity;
    }
}
