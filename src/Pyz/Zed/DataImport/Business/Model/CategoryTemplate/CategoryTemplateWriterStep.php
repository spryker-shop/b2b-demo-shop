<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\CategoryTemplate;

use Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class CategoryTemplateWriterStep implements DataImportStepInterface
{
    /**
     * @var string
     */
    public const KEY_NAME = 'template_name';

    /**
     * @var string
     */
    public const KEY_PATH = 'template_path';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $categoryTemplateEntity = SpyCategoryTemplateQuery::create()
            ->filterByName($dataSet[static::KEY_NAME])
            ->findOneOrCreate();

        $categoryTemplateEntity->setTemplatePath($dataSet[static::KEY_PATH]);

        if (!$categoryTemplateEntity->isNew() && !$categoryTemplateEntity->isModified()) {
            return;
        }

        $categoryTemplateEntity->save();
    }
}
