<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\CmsTemplate;

use Orm\Zed\Cms\Persistence\SpyCmsTemplateQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class CmsTemplateWriterStep implements DataImportStepInterface
{
    /**
     * @var string
     */
    public const KEY_TEMPLATE_NAME = 'template_name';

    /**
     * @var string
     */
    public const KEY_TEMPLATE_PATH = 'template_path';

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $cmsTemplate = SpyCmsTemplateQuery::create()
            ->filterByTemplateName($dataSet[static::KEY_TEMPLATE_NAME])
            ->findOneOrCreate();

        $cmsTemplate
            ->setTemplatePath($dataSet[static::KEY_TEMPLATE_PATH])
            ->save();
    }
}
