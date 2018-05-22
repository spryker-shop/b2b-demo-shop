<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\DataImport\Business\Model\FileType;

use Orm\Zed\FileManager\Persistence\SpyFileType;
use Orm\Zed\FileManager\Persistence\SpyFileTypeQuery;
use Pyz\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class FileTypeWriter extends PublishAwareStep implements DataImportStepInterface
{
    const BULK_SIZE = 100;

    const KEY_EXTENSION = 'extension';
    const KEY_MIME_TYPE = 'mime_type';
    const KEY_IS_ALLOWED = 'is_allowed';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $fileTypeEntity = SpyFileTypeQuery::create()->findOneByExtension($dataSet[static::KEY_EXTENSION]);

        if ($fileTypeEntity !== null) {
            return;
        }

        $this->createFileTypeEntityFromDataset($dataSet)->save();
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileType
     */
    protected function createFileTypeEntityFromDataset(DataSetInterface $dataSet)
    {
        $fileTypeEntity = new SpyFileType();
        $fileTypeEntity->setExtension($dataSet[static::KEY_EXTENSION]);
        $fileTypeEntity->setMimeType($dataSet[static::KEY_MIME_TYPE]);
        $fileTypeEntity->setIsAllowed($dataSet[static::KEY_IS_ALLOWED]);

        return $fileTypeEntity;
    }
}
