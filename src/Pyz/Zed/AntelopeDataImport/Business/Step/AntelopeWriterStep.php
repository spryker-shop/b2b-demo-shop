<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeDataImport\Business\Step;

use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AntelopeWriterStep implements DataImportStepInterface
{
    public const KEY_NAME = 'name';
    public const KEY_COLOR = 'color';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $antelopeEntity = PyzAntelopeQuery::create()
            ->filterByName($dataSet[static::KEY_NAME])
            ->findOneOrCreate();

        $antelopeEntity->setColor($dataSet[static::KEY_COLOR]);

        if ($antelopeEntity->isNew() || $antelopeEntity->isModified()) {
            $antelopeEntity->save();
        }
    }
}
