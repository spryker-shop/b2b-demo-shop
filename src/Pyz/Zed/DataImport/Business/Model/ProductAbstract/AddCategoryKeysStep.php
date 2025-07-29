<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Pyz\Zed\DataImport\Business\Model\ProductAbstract;

use Orm\Zed\Category\Persistence\SpyCategoryQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AddCategoryKeysStep implements DataImportStepInterface
{
    /**
     * @var string
     */
    public const KEY_CATEGORY_KEYS = 'categoryKeys';

    /**
     * @var array<string, int>
     */
    protected $categoryKeys = [];

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        if (!$this->categoryKeys) {
            /** @var array<\Orm\Zed\Category\Persistence\SpyCategory> $categoryEntityCollection */
            $categoryEntityCollection = SpyCategoryQuery::create()->find();

            foreach ($categoryEntityCollection as $categoryEntity) {
                $this->categoryKeys[$categoryEntity->getCategoryKey()] = $categoryEntity->getIdCategory();
            }
        }

        $dataSet[static::KEY_CATEGORY_KEYS] = $this->categoryKeys;
    }
}
